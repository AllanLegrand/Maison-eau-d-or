<?php
namespace App\Controllers;
use App\Models\UtilisateursModel;

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
		
		$rules = [
			'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[utilisateurs.email]',
			'nom' => 'required|min_length[2]|max_length[50]',
			'prenom' => 'required|min_length[2]|max_length[50]',
			'password' => 'required|min_length[4]|max_length[50]',
			'confirmpassword' => 'matches[password]',
			'adresse' => 'min_length[10]|max_length[255]',
			'news' => 'permit_empty|in_list[0,1]',
		];

		if ($this->validate($rules)) {
			$UtilisateurModele = new UtilisateurModele();

			$data = [
				'email' => $this->request->getVar('email'), 
				'nom' => $this->request->getVar('nom'),
				'prenom' => $this->request->getVar('prenom'),
				'mdp' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
				'adresse' => $this->request->getVar('adresse'),
				'news' => $this->request->getVar('news'),
				'resettoken' => null,
				'resettokenexpiration' => null
			];

			$UtilisateurModele->save($data);

			return redirect()->to('/signin');
		} else {
			$data['validation'] = $this->validator;
			echo view('signup', $data);
		}
	}
}