<?php

namespace App\Controllers;

use App\Models\ProduitsModel;

class Accueil extends BaseController
{
	public function index()
	{
		$produitsModel = new ProduitsModel();

		$produitsCoffret = $produitsModel->getProduitByFilter('coffrets');
		$produitsBestsellers = $produitsModel->getProduitByFilter('Bestsellers');
		$produitVedette = $produitsModel->getProduitByFilter('vedette')[0];
		echo view('header', ['title' => 'Accueil']);
		echo view('accueil', [
			'produitsCoffret' => $produitsCoffret,
			'produitsBestsellers' => $produitsBestsellers,
			'produitVedette' => $produitVedette
		]);
		echo view('footer');
	}
}
