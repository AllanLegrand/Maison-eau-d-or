<?php
namespace App\Controllers;

use App\Models\ProduitsModel;
use App\Models\CategoriesModel;
use App\Models\PanierModel;
use App\Config\Pager;

class BoutiqueController extends BaseController
{
	public function index()
	{
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

		$produits = $produitsModel->getProduitsParCategorie($catId, $perPage, $offset);
		$totalProduits = $produitsModel->getTotalProduitsParCategorie($catId);

		foreach ($produits as &$produit) {
			$imagePath = './assets/img/' . $produit['img_path'];
			if (!file_exists($imagePath) || empty($produit['img_path'])) {
				$produit['img_path'] = 'default.png';
			}
		}

		$data = [
			'categories' => $categories,
			'produits' => $produits,
			'currentCategory' => $catId,
			'pager' => $pager->makeLinks($currentPage, $perPage, $totalProduits, 'default_full')
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
}
