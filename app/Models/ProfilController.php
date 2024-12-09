<?php
namespace App\Controllers;

use App\Models\UtilisateursModel;

class ProfilController extends BaseController
{
    public function index()
	{
		$session = session();
		$userId = $session->get('id_util');

		if (!$userId) {
			return redirect()->to('/signin');
		}

		$model = new UtilisateursModel();
		$data['utilisateur'] = $model->find($userId);

		echo view('header', ['title' => 'Profil']);
		echo view('profil', $data);
		echo view('footer');
	}

    public function modifierProfil()
    {
		$session = session();
		$userId = $session->get('id_util');

		if (!$userId) {
			return redirect()->to('/signin');
		}

		$model = new UtilisateursModel();

		$data = $this->request->getPost();
		$rules = [
			'nom' => 'required|min_length[3]',
			'prenom' => 'required|min_length[3]',
			'email' => 'required|valid_email',
			'adresse' => 'required|min_length[5]',
		];

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('error', 'Veuillez corriger les erreurs.');
		}

        if ($model->modifUtilisateurs($userId, $data)) {
            return redirect()->to('/profil')->with('message', 'Informations mises à jour avec succès.');
        }
    }
}
