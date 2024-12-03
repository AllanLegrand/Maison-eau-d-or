<?php
namespace App\Controllers;

use App\Models\ProduitsModel;

class BoutiqueController extends BaseController
{
	public function index()
	{
		$produitsModel = new ProduitsModel();

		$data['produits'] = $produitsModel->findAll();

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