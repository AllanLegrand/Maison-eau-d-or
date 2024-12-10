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

		$this->sendNewsletterEmails($titre, $msg);

		return redirect()->to('/blog')->with('message', 'Article ajouté avec succès !');
	}

	private function sendNewsletterEmails(string $titre, string $msg)
	{
		$utilisateurModel = new UtilisateursModel();

		$subscribers = $utilisateurModel->getNewsletterSubscribers();

		if (!empty($subscribers)) {
			$email = \Config\Services::email();

			foreach ($subscribers as $subscriber) {
				$email->setTo($subscriber['email']);
				$email->setFrom('no-reply@yourdomain.com', 'Votre Blog');
				$email->setSubject('Maison Eau D\'Or | Nouvel article publié ');
				$email->setMessage(
					'<h1>' . $titre . '</h1>' .
					'<p>' . nl2br($msg) . '</p>' .
					'<p><a href="' . base_url('/blog') . '">Voir l\'article</a></p>'
				);

				if (!$email->send()) {
					log_message('error', 'Échec de l\'envoi de l\'e-mail à ' . $subscriber['email']);
				}
			}
		}
	}
}