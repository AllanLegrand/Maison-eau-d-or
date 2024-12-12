<?php

namespace App\Controllers;

class AProposController extends BaseController
{
	public function index()
	{
		echo view('header', ['title' => 'apropos']);
		echo view('apropos');
		echo view('footer');
	}
}

?>