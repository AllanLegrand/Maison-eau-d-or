<?php
namespace App\Controllers;

use App\Models\ProdCatModel;
use App\Models\ProduitsModel;
use App\Models\CategoriesModel;
use App\Models\PanierModel;
use App\Models\UtilisateursModel;
use App\Config\Pager;

class BoutiqueController extends BaseController
{
	public function index()
	{
		$session = session();

		$utilisateurModel = new UtilisateursModel();

		$admin = $session->get('isLoggedIn') && $utilisateurModel->isAdmin($session->get('id_util'));

		$produitsModel = new ProduitsModel();
		$categoriesModel = new CategoriesModel();
		$configPager = config(Pager::class);

		$perPage = $configPager->perPage;
		$currentPage = $this->request->getVar('page') ?? 1;
		$offset = ($currentPage - 1) * $perPage;
		$pager = service('pager');

		$categories = $categoriesModel->findAll();
		$catId = $this->request->getGet('cat');
		$catId = ($catId === null || $catId === '') ? null : (int)$catId;

		$produits = $produitsModel->getProduitsParCategorie($catId, $perPage, $offset, $admin);
		
		$totalProduits = $produitsModel->getTotalProduitsParCategorie($catId, $admin);

		foreach ($produits as &$produit) {
			$imagePath = './assets/img/' . $produit['img_path'];
			if (!file_exists($imagePath) || empty($produit['img_path'])) {
				$produit['img_path'] = 'default.png';
			}
		}

		$modelProdCat = new ProdCatModel();
		$dictionnaire = $modelProdCat->getProdCatDictionary();

		$data = [
			'categories' => $categories,
			'produits' => $produits,
			'currentCategory' => $catId,
			'pager' => $pager->makeLinks($currentPage, $perPage, $totalProduits, 'default_full'),
			'admin' => $admin,
			'dicProdCat' => $dictionnaire,
		];

		echo view('header', ['title' => 'Boutique']);
		echo view('boutique', $data);
		echo view('footer');
	}

	public function getProduit($id_prod)
	{
		$produitsModel = new ProduitsModel();
		$produit = $produitsModel->getProduitById($id_prod);

		if ($produit) {
			return $this->response->setJSON($produit);
		} else {
			return $this->response->setJSON(['error' => 'Produit non trouvé']);
		}
	}

	public function addToCart()
	{
		$session = session();
		$id_sess = $session->session_id;
		$data = $this->request->getJSON(true);
		$id_prod = $data['id_prod'] ?? null;
		$qt = $data['qt'] ?? 1;

		if (!$id_prod) {
			return $this->response->setJSON(['success' => false, 'error' => 'ID produit manquant.'], 400);
		}

		$panierModel = new PanierModel();

		$existing = $panierModel->where(['id_prod' => $id_prod, 'id_sess' => $id_sess])->first();

		if ($existing) {
			$newQt = $existing['qt'] + $qt;
			$panierModel->where(['id_prod' => $id_prod, 'id_sess' => $id_sess])
						->set(['qt' => $newQt])
						->update();
			$message = 'Quantité mise à jour dans le panier.';
		} else {
			$panierModel->ajouterPanier([
				'id_prod' => $id_prod,
				'id_sess' => $id_sess,
				'qt' => $qt
			]);
			$message = 'Produit ajouté au panier.';
		}

		return $this->response->setJSON(['success' => true, 'message' => $message]);
	}

	public function getCartItems()
	{
		$session = session();
		$id_sess = $session->session_id;

		$panierModel = new PanierModel();
		$panierItems = $panierModel->where('id_sess', $id_sess)
							       ->orderBy('id_prod', 'ASC')
							       ->findAll();

		$produitsModel = new ProduitsModel();
		$cartProducts = [];

		foreach ($panierItems as $item) {
			$produit = $produitsModel->find($item['id_prod']);
			if ($produit) {
				$cartProducts[] = [
					'id_prod' => $produit['id_prod'],
					'nom' => $produit['nom'],
					'prix' => $produit['prix'],
					'quantite' => $item['qt'],
					'image' => base_url('assets/img/' . ($produit['img_path'] ?: 'default.png'))
				];
			}
		}

		return $this->response->setJSON($cartProducts);
	}

	public function updateQuantity()
	{
		$input = $this->request->getJSON();
		$session = session();
		$id_sess = $session->session_id;
		$id_prod = $input->id_prod;
		$quantite = $input->quantite;

		$panierModel = new PanierModel();
		$result = $panierModel->where('id_prod', $id_prod)
							  ->where('id_sess', $id_sess)
							  ->set(['qt' => $quantite])
							  ->update();

		return $this->response->setJSON(['success' => $result]);
	}


	public function removeItem()
	{
		$input = $this->request->getJSON();
		$session = session();
		$id_sess = $session->session_id;
		$id_prod = $input->id_prod;

		$panierModel = new PanierModel();
		$result = $panierModel->where('id_prod', $id_prod)
                              ->where('id_sess', $id_sess)
                              ->delete();

		return $this->response->setJSON(['success' => $result]);
	}

	public function addProduit() {
		$session = session();

		$utilisateurModel = new UtilisateursModel();

		if(!$session->get('isLoggedIn') || !$utilisateurModel->isAdmin($session->get('id_util'))) {
			return redirect()->to('/Accueil');
		}

		$image = $this->request->getFile('image');

		$data = [
			'nom' => $this->request->getPost('nom'),
			'prix' => $this->request->getPost('prix'),
			'description' => $this->request->getPost('description'),
			'actif' => $this->request->getPost('actif')
		];

		if ($image && $image->isValid() && !$image->hasMoved()) {
			$targetPath = 'assets/img';
		
			// Vérifier si le dossier existe, sinon le créer
			if (!is_dir($targetPath)) {
				mkdir($targetPath, 0755, true);
			}
		
			// Renommer l'image pour éviter les conflits
			$newName = $image->getRandomName();
		
			// Déplacer l'image vers le dossier uploads
			$image->move($targetPath, $newName);
		
			$data['img_path'] = $newName;
		}
		
		$model = new ProduitsModel();
		$model->insert($data);

		$categories = $this->request->getPost('categories');

		$modelCat = new ProdCatModel();
		$data = [
			'id_prod' => $model->getInsertID(),
		];

		foreach($categories as $categorie) {
			$data['id_cat'] = $categorie;

			$modelCat->insert($data);
		}

		return redirect()->to('/boutique')->with('message', 'Produit ajouté avec succès !');
	}

	public function editProduit() {
		$session = session();

		$utilisateurModel = new UtilisateursModel();

		if(!$session->get('isLoggedIn') || !$utilisateurModel->isAdmin($session->get('id_util'))) {
			return redirect()->to('/Accueil');
		}

		$image = $this->request->getFile('image');

		$id_prod = $this->request->getPost('id_prod');

		$data = [
			'nom' => $this->request->getPost('nom'),
			'prix' => $this->request->getPost('prix'),
			'description' => $this->request->getPost('description'),
			'actif' => $this->request->getPost('actif')
		];

		if ($image && $image->isValid() && !$image->hasMoved()) {
			$targetPath = 'assets/img';
		
			// Vérifier si le dossier existe, sinon le créer
			if (!is_dir($targetPath)) {
				mkdir($targetPath, 0755, true);
			}
		
			// Renommer l'image pour éviter les conflits
			$newName = $image->getRandomName();
		
			// Déplacer l'image vers le dossier uploads
			$image->move($targetPath, $newName);
		
			$data['img_path'] = $newName;
		}
		
		$model = new ProduitsModel();
		if (!$model->find($id_prod)) {
			return redirect()->back()->with('error', 'Produit introuvable.');
		}
		$model->update($id_prod, $data);

		$categories = $this->request->getPost('categories');

		$modelCat = new ProdCatModel();

		$modelCat->reintialiseProdCat($id_prod);

		foreach($categories as $categorie) {
			$data = [
				'id_prod' => $id_prod,
				'id_cat' => $categorie
			];

			$modelCat->insertComposite($data);
		}

		return redirect()->to('/boutique')->with('message', 'Produit ajouté avec succès !');
	}

	public function suppProduit(int $id_prod) {
		$session = session();

		$utilisateurModel = new UtilisateursModel();

		if(!$session->get('isLoggedIn') || !$utilisateurModel->isAdmin($session->get('id_util'))) {
			return redirect()->to('/Accueil');
		}

		$model = new ProduitsModel();

		if($model->delete($id_prod)) {
			return redirect()->back()->with('message', 'Produit supprimé avec succès.');
		}
		else {
			return redirect()->back()->with('error', 'Erreur lors de la suppression du produit.');
		}
	}
}
