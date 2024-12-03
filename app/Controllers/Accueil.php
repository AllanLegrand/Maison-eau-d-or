<?php

namespace App\Controllers;

use App\Models\ProduitsModel;
use App\Models\UtilisateursModel;
class Accueil extends BaseController
{
	public function index()
	{
		$produitsModel = new ProduitsModel();

		$produitsCoffret = $produitsModel->getProduitByFilter('coffrets');
		$produitsBestsellers = $produitsModel->getProduitByFilter('Bestsellers');
		$produitVedette = $produitsModel->getProduitByFilter('vedette')[0];

		$session = session();

		$userId = $session->get('idutil');
		$utilisateurModel = new UtilisateursModel();
		$afficheNews = !$session->get('isLoggedIn') || !$utilisateurModel->isSubscribed($userId);

		echo view('header', ['title' => 'Accueil']);
		echo view('accueil', [
			'produitsCoffret' => $produitsCoffret,
			'produitsBestsellers' => $produitsBestsellers,
			'produitVedette' => $produitVedette,
			'afficheNews' => $afficheNews
		]);
		echo view('footer');
	}
}
