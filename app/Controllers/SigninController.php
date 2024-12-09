<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UtilisateursModel;
use App\Models\PanierModel;

class SigninController extends BaseController
{
	public function index()
	{
		helper(['form']);
		$data = []; // Initialisation des données pour les erreurs et valeurs saisies
		echo view('signin', $data);
	}

	public function loginAuth()
	{
		helper(['form']);
		$session = session();
		$UtilisateurModel = new UtilisateursModel();

		$rules = [
			'email' => 'required|valid_email',
			'password' => 'required'
		];

		if (!$this->validate($rules)) {
			$data = [
				'validation' => $this->validator
			];
			return view('signin', $data);
		}

		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		$data = $UtilisateurModel->where('email', $email)->first();

		if ($data) {
			$pass = $data['mdp'];
			$authenticatePassword = password_verify($password, $pass);

			if ($authenticatePassword) {
				$currentSessionId = $session->session_id;
            	$userId = $data['id_util'];
				$PanierModel = new PanierModel();
            	$PanierModel->migrerPanierVersUtilisateur($currentSessionId, $userId);

				$ses_data = [
					'id_util' => $userId,
					'nom' => $data['nom'],
					'prenom' => $data['prenom'],
					'email' => $data['email'],
					'isLoggedIn' => true
				];
				$session->set($ses_data);
				return redirect()->to('/Accueil');
			} else {
				$data['validation'] = $this->validator;
				$data['validation']->setError('password', 'Mot de passe incorrect.');
				return view('signin', $data);
			}
		} else {
			$data['validation'] = $this->validator;
			$data['validation']->setError('email', 'L\'adresse e-mail n\'existe pas.');
			return view('signin', $data);
		}
	}


}