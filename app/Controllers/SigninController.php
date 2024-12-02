<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UtilisateurModele;

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
		$UtilisateurModele = new UtilisateurModele();

		// Règles de validation pour l'e-mail et le mot de passe
		$rules = [
			'email' => 'required|valid_email',
			'password' => 'required'
		];

		// Validation des données d'entrée
		if (!$this->validate($rules)) {
			// Si la validation échoue, renvoyer les erreurs de validation
			$data = [
				'validation' => $this->validator
			];
			return view('signin', $data);
		}

		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		// Recherche de l'utilisateur dans la base de données
		$data = $UtilisateurModele->where('email', $email)->first();

		if ($data) {
			$pass = $data['mdp'];
			$authenticatePassword = password_verify($password, $pass);

			if ($authenticatePassword) {
				// Connexion réussie, stockage des données de session
				$ses_data = [
					'id_util' => $data['id_util'],
					'nom' => $data['nom'],
					'prenom' => $data['prenom'],
					'email' => $data['mail'],
					'isLoggedIn' => true
				];
				$session->set($ses_data);
				return redirect()->to('/Accueil');
			} else {
				// Mot de passe incorrect
				// Nous devons créer une erreur de validation pour le mot de passe
				$data['validation'] = $this->validator;
				$data['validation']->setError('password', 'Mot de passe incorrect.');
				return view('signin', $data);
			}
		} else {
			// E-mail non trouvé
			// Nous devons créer une erreur de validation pour l'email
			$data['validation'] = $this->validator;
			$data['validation']->setError('email', 'L\'adresse e-mail n\'existe pas.');
			return view('signin', $data);
		}
	}


}