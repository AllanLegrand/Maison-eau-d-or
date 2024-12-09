<?php

namespace App\Controllers;

use App\Models\UtilisateursModel;
use CodeIgniter\Controller;

class UtilisateurController extends Controller
{

	public function checkAuth()
	{
		$session = session();
		$isLoggedIn = $session->get('isLoggedIn');

		return $this->response->setJSON(['isLoggedIn' => $isLoggedIn]);
	}
	
	public function getUserDetails()
	{
		$session = session();
		if (!$session->get('isLoggedIn')) {
			return $this->response->setJSON(['error' => 'Non authentifié'], 401);
		}

		$userId = $session->get('id_util');
		$userModel = new \App\Models\UtilisateursModel();
		$user = $userModel->find($userId);

		if ($user) {
			return $this->response->setJSON([
				'nom' => $user['nom'],
				'prenom' => $user['prenom'],
				'email' => $user['email'],
				'adresse' => $user['adresse'],
			]);
		}

		return $this->response->setJSON(['error' => 'Utilisateur non trouvé'], 404);
	}

	public function deconnexion()
    {
        $session = session();
        $session->destroy();

        return $this->response->setJSON(['success' => true]);
    }
}