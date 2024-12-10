<?php

namespace App\Controllers;

use App\Models\ProduitsModel;
use App\Models\UtilisateursModel;
class Accueil extends BaseController
{
	public function index()
	{
		$produitsModel = new ProduitsModel();

		$produitsCoffret = $produitsModel->getProduitByFilter('Coffrets');
		$produitsBestsellers = $produitsModel->getProduitByFilter('Best-sellers');
		$produitVedette = $produitsModel->getProduitByFilter('Vedette')[0];

		$session = session();

		$userId = $session->get('id_util');
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

	public function subscribeToNewsletter()
	{
		$session = session();

		if (!$session->get('isLoggedIn')) {
			return redirect()->to('/signin');
		}

		$userId = $session->get('id_util');
		$utilisateurModel = new UtilisateursModel();

		$utilisateurModel->update($userId, ['news' => true]);

		return redirect()->to('/');
	}
}

?>
