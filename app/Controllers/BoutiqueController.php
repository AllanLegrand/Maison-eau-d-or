<?php
namespace App\Controllers;

use App\Models\ProduitsModel;
use App\Models\CategoriesModel;
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

		$data = [
			'categories' => $categories,
			'produits' => $produits,
			'currentCategory' => $catId, // Ajout de la catégorie actuelle
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
}
