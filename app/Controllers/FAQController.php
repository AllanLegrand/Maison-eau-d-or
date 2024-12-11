<?php

namespace App\Controllers;

use App\Models\FAQModel;
use App\Models\UtilisateursModel;

class FAQController extends BaseController
{
    protected $faqModel;
    protected $utilisateurModel;

    public function __construct()
    {
        $this->faqModel = new FAQModel();
        $this->utilisateurModel = new UtilisateursModel();
    }

    // Afficher la page des FAQ
    public function index()
    {
        $session = session();
        $admin = $session->get('isLoggedIn') && $this->utilisateurModel->isAdmin($session->get('id_util'));

        $data = [
            'faqs' => $this->faqModel->getFAQ(),
            'isAdmin' => $admin,
        ];

		echo view('header', ['title' => 'FAQ']);
		echo view('faq', $data);
		echo view('footer'); 
    }

    // Ajouter une nouvelle FAQ
    public function ajouter()
    {
        $session = session();
        $admin = $session->get('isLoggedIn') && $this->utilisateurModel->isAdmin($session->get('id_util'));

        if (!$admin) {
            return redirect()->to('/faq')->with('error', 'Permission refusée.');
        }

        $data = [
            'txt' => $this->request->getPost('txt')
        ];

        if ($this->faqModel->ajouterFAQ($data)) {
            return redirect()->to('/faq')->with('success', 'FAQ ajoutée avec succès.');
        } else {
            return redirect()->to('/faq')->with('error', 'Échec de l’ajout de la FAQ.');
        }
    }

    // Modifier une FAQ existante
    public function modifier($id_faq)
    {
        $session = session();
        $admin = $session->get('isLoggedIn') && $this->utilisateurModel->isAdmin($session->get('id_util'));

        if (!$admin) {
            return redirect()->to('/faq')->with('error', 'Permission refusée.');
        }

        $data = [
            'txt' => $this->request->getPost('txt')
        ];

        if ($this->faqModel->modifFAQ($id_faq, $data)) {
            return redirect()->to('/faq')->with('success', 'FAQ modifiée avec succès.');
        } else {
            return redirect()->to('/faq')->with('error', 'Échec de la modification de la FAQ.');
        }
    }

    // Supprimer une FAQ
    public function supprimer($id_faq)
    {
        $session = session();
        $admin = $session->get('isLoggedIn') && $this->utilisateurModel->isAdmin($session->get('id_util'));

        if (!$admin) {
            return redirect()->to('/faq')->with('error', 'Permission refusée.');
        }

        if ($this->faqModel->supprFAQ($id_faq)) {
            return redirect()->to('/faq')->with('success', 'FAQ supprimée avec succès.');
        } else {
            return redirect()->to('/faq')->with('error', 'Échec de la suppression de la FAQ.');
        }
    }
}