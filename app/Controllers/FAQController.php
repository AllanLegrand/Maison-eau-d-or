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

    public function contact()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $message = $this->request->getPost('message');

        if (!$name || !$email || !$message) {
            return redirect()->to('/faq')->with('error', 'Tous les champs doivent être remplis.');
        }

        $emailService = \Config\Services::email();

        $emailService->setFrom('eaudormaison@gmail.com', 'FAQ - Maison Eau d\'Or');
        $emailService->setTo('eaudormaison@gmail.com');
        $emailService->setSubject('Message de contact - FAQ');
        $emailService->setMessage("
            <h2>Nouveau message reçu depuis la FAQ</h2>
            <p><strong>Nom :</strong> {$name}</p>
            <p><strong>Email :</strong> {$email}</p>
            <p><strong>Message :</strong><br>{$message}</p>
        ");

        if ($emailService->send()) {
            return redirect()->to('/faq')->with('success', 'Votre message a été envoyé avec succès.');
        } else {
            $data = $emailService->printDebugger(['headers']);
            log_message('error', $data);
            return redirect()->to('/faq')->with('error', 'Une erreur s’est produite lors de l’envoi de votre message.');
        }
    }
}