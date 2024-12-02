<?php
namespace App\Controllers;
use App\Models\UtilisateurModele;

class SignupController extends BaseController
{
	public function index()
	{
		helper(['form']);
		$data = [];
		echo view('signup', $data);
	}

	public function store()
	{
		helper(['form']);
		
		// Règles de validation mises à jour avec 'utilisateur.mail'
		$rules = [
			'mail' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[utilisateur.mail]',
			'nom' => 'required|min_length[2]|max_length[50]',
			'prenom' => 'required|min_length[2]|max_length[50]',
			'password' => 'required|min_length[4]|max_length[50]',
			'confirmpassword' => 'matches[password]',
			'adresse' => 
		];

		// Vérification des règles de validation
		if ($this->validate($rules)) {
			$UtilisateurModele = new UtilisateurModele();

			// Données à insérer dans la table utilisateur
			$data = [
				'email' => $this->request->getVar('mail'), // Utilisation de 'mail'
				'nom' => $this->request->getVar('nom'),
				'prenom' => $this->request->getVar('prenom'),
				'mdp' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
				'adresse' => $this->request->getVar('prenom'),
				// 'created_at' sera géré automatiquement si $useTimestamps = true
				'resettoken' => null,
				'resettokenexpiration' => null
			];

			// Sauvegarde de l'utilisateur dans la base de données
			$UtilisateurModele->save($data);

			// Redirection après inscription
			return redirect()->to('/signin');
		} else {
			// Si les règles ne sont pas respectées, renvoi des erreurs de validation
			$data['validation'] = $this->validator;
			echo view('signup', $data);
		}
	}
}