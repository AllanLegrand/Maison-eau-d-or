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
			'email' => [
				'rules' => 'required|valid_email|is_unique[utilisateurs.email]|min_length[4]|max_length[100]',
				'errors' => [
					'required' => 'L\'adresse e-mail est obligatoire.',
					'valid_email' => 'Veuillez saisir une adresse e-mail valide.',
					'is_unique' => 'Cette adresse e-mail est déjà utilisée.',
					'min_length' => 'L\'adresse e-mail doit contenir au moins 4 caractères.',
					'max_length' => 'L\'adresse e-mail ne peut pas dépasser 100 caractères.'
				],
			],
			'nom' => [
				'rules' => 'required|alpha|min_length[2]|max_length[50]',
				'errors' => [
					'required' => 'Le nom est obligatoire.',
					'min_length' => 'Le nom doit contenir au moins 2 caractères.',
					'max_length' => 'Le nom ne peut pas dépasser 50 caractères.'
				],
			],
			'prenom' => [
				'rules' => 'required|alpha|min_length[2]|max_length[50]',
				'errors' => [
					'required' => 'Le prénom est obligatoire.',
					'min_length' => 'Le prénom doit contenir au moins 2 caractères.',
					'max_length' => 'Le prénom ne peut pas dépasser 50 caractères.'
				],
			],
			'adresse' => [
				'rules' => 'required|min_length[5]|max_length[255]',
				'errors' => [
					'required' => 'L\'adresse est obligatoire.',
					'min_length' => 'L\'adresse doit contenir au moins 5 caractères.',
					'max_length' => 'L\'adresse ne peut pas dépasser 255 caractères.'
				],
			],
			'password' => [
				'rules' => 'required|min_length[6]|max_length[50]',
				'errors' => [
					'required' => 'Le mot de passe est obligatoire.',
					'min_length' => 'Le mot de passe doit contenir au moins 6 caractères.',
					'max_length' => 'Le mot de passe ne peut pas dépasser 50 caractères.'
				],
			],
			'confirmpassword' => [
				'rules' => 'matches[password]',
				'errors' => [
					'matches' => 'La confirmation du mot de passe ne correspond pas au mot de passe.'
				],
			],
		];


		if ($this->validate($rules)) {
			$UtilisateurModele = new UtilisateursModel();

			$data = [
				'email' => $this->request->getVar('email'),
				'nom' => $this->request->getVar('nom'),
				'prenom' => $this->request->getVar('prenom'),
				'mdp' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
				'news' => $this->request->getVar('news') === "on",
				'adresse' => $this->request->getVar('adresse'),
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