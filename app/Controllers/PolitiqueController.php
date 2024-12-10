<?php

namespace App\Controllers;

use App\Models\ProduitsModel;
use App\Models\UtilisateursModel;
class PolitiqueController extends BaseController
{
	public function index()
	{

		echo view('header', ['title' => 'politique_confidentialite']);
		echo view('politique_confidentialite');
		echo view('footer');
	}
}

?>