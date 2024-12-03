<?php

namespace App\Controllers;

class Accueil extends BaseController
{
    public function index()
    {
        echo view('header', ['title' => 'Accueil']);
        echo view('accueil');
        echo view('footer');
    }
}
