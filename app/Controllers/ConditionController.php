<?php

namespace App\Controllers;

use App\Models\ProduitsModel;
use App\Models\UtilisateursModel;
class ConditionController extends BaseController
{
	public function index()
	{

		echo view('header', ['title' => 'Conditions_generales']);
		echo view('conditions_generales');
		echo view('footer');
	}
}

?>