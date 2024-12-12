<?php

namespace App\Controllers;

use App\Models\AproposModel;
use App\Models\UtilisateursModel;

class AProposController extends BaseController
{
	public function index()
	{
		$aproposModel = new AproposModel();
		$apropos = $aproposModel->getApropos();
		$utilisateurModel = new UtilisateursModel();

		$session = session();
		$admin = $session->get('isLoggedIn') && $utilisateurModel->isAdmin($session->get('id_util'));

		echo view('header', ['title' => 'apropos']);
		echo view('apropos', [
			'apropos' => $apropos,
			'admin' => $admin
		]);
		echo view('footer');
	}

	public function editApropos() {
		$session = session();

		$utilisateurModel = new UtilisateursModel();

		if(!$session->get('isLoggedIn') || !$utilisateurModel->isAdmin($session->get('id_util'))) {
			return redirect()->to('/Accueil');
		}

		$aproposModel = new AproposModel();
		$apropos = $aproposModel->getApropos();
		if(!isset($apropos['id_pro'])){
			return redirect()->back()->with('error', 'A propos introuvable.');
		}

		$id_pro = $apropos['id_pro'];

		$data = [
			'msg' => $this->request->getPost('msg'),
		];
		
		$model = new AproposModel();
		if (!$model->find($id_pro)) {
			return redirect()->back()->with('error', 'A propos introuvable.');
		}
		$model->update($id_pro, $data);

		return redirect()->to('/apropos')->with('message', 'Categorie modifié avec succès !');
	}
}

?>