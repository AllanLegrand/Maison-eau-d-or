<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\UtilisateursModel;

class ArticleController extends BaseController
{
	public function index($perPage = 10)
	{
		$session = session();

		$utilisateurModel = new UtilisateursModel();

		$admin = $session->get('isLoggedIn') && $utilisateurModel->isAdmin($session->get('id_util'));

		$articleModel = new ArticleModel();

		$articles = $articleModel->getPaginatedArticles($perPage);
		echo view('header', ['title' => 'Accueil']);
		echo view('article', [
			'articles' => $articles,
			'pager' => $articleModel->pager,
			'admin' => $admin
		]);
		echo view('footer');
	}

	public function addArticle() 
	{
		$session = session();

		$utilisateurModel = new UtilisateursModel();

		if(!$session->get('isLoggedIn') || !$utilisateurModel->isAdmin($session->get('id_util'))) {
			return redirect()->to('/Accueil');
		}

		$titre = $this->request->getPost('titre');
		$msg = $this->request->getPost('description');

		$image = $this->request->getFile('image');
	
		$data = [
			'titre' => $titre,
			'msg' => $msg,
		];

		if ($image && $image->isValid() && !$image->hasMoved()) {
			$targetPath = 'assets/img';
		
			// Vérifier si le dossier existe, sinon le créer
			if (!is_dir($targetPath)) {
				mkdir($targetPath, 0755, true);
			}
		
			// Renommer l'image pour éviter les conflits
			$newName = $image->getRandomName();
		
			// Déplacer l'image vers le dossier uploads
			$image->move($targetPath, $newName);
		
			$data['img_path'] = $newName;
		}
		
		$model = new ArticleModel();
		$model->insert($data);
	
		return redirect()->to('/blog')->with('message', 'Article ajouté avec succès !');
	}
}