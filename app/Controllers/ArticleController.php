<?php

namespace App\Controllers;

use App\Models\ArticleModel;

class ArticleController extends BaseController
{
	public function index($perPage = 10)
	{
		$articleModel = new ArticleModel();

		$articles = $articleModel->getPaginatedArticles($perPage);
		echo view('header', ['title' => 'Accueil']);
		echo view('article', [
			'articles' => $articles,
			'pager' => $articleModel->pager
		]);
		echo view('footer');
	}
}