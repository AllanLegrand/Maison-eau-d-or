<?php
namespace App\Controllers;

use App\Models\ProduitsModel;
use App\Config\Pager;

class BoutiqueController extends BaseController
{
	public function index()
	{
		$produitsModel = new ProduitsModel();

		$configPager = config(Pager::class);
		$perPage = $configPager->perPage;

		$currentPage = $this->request->getVar('page') ?? 1;

		$offset = ($currentPage - 1) * $perPage;

		$pager = service('pager');

		$produits = $produitsModel->getProduitsPagines($perPage, $offset);
		$totalProduits = $produitsModel->getTotalProduits();
		$data = [
			'produits' => $produits,
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
