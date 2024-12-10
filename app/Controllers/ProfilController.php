<?php
namespace App\Controllers;

use App\Models\UtilisateursModel;
use App\Models\CommandesModel;
use App\Models\HistoriqueModel;
use App\Models\ProduitsModel;
use App\Config\Pager;

class ProfilController extends BaseController
{
    public function index()
	{
		$session = session();
		$userId = $session->get('id_util');

		if (!$userId) {
			return redirect()->to('/signin');
		}

		$utilisateurModel = new UtilisateursModel();
		$commandesModel = new CommandesModel();
		$historiqueModel = new HistoriqueModel();
		$produitsModel = new ProduitsModel();
		$pager = service('pager');
		$configPager = config(Pager::class);

		// Récupérer l'utilisateur
		$data['utilisateur'] = $utilisateurModel->find($userId);

		// Pagination
		$perPage = 3; // Nombre de commandes par page
		$currentPage = $this->request->getVar('page') ?? 1; // Page actuelle
		$offset = ($currentPage - 1) * $perPage; // Décalage des résultats pour la pagination

		// Récupérer les commandes paginées
		$historiqueCommandes = $commandesModel
			->where('id_util', $userId)
			->orderBy('date', 'DESC')
			->findAll($perPage, $offset); // Obtenir les commandes paginées

		// Total des commandes
		$totalCommandes = $commandesModel->where('id_util', $userId)->countAllResults(); 

		// Récupérer les détails des produits pour chaque commande
		$historiqueDetails = [];
		foreach ($historiqueCommandes as $commande) {
			$historiqueModel = new HistoriqueModel();
			$produitsHistorique = $historiqueModel->where('id_com', $commande['id_com'])->findAll();

			$produits = [];
			$totalCommande = 0;

			foreach ($produitsHistorique as $produitHistorique) {
				$produitModel = new ProduitsModel();
				$produit = $produitModel->find($produitHistorique['id_prod']);

				if ($produit) {
					$produits[] = [
						'id_prod' => $produit['id_prod'],
						'nom' => $produit['nom'],
						'prix' => $produit['prix'],
						'image' => base_url('assets/img/' . ($produit['img_path'] ?: 'default.png')),
						'quantite' => $produitHistorique['qt'],
					];

					$totalCommande += $produit['prix'] * $produitHistorique['qt'];
				}
			}

			$historiqueDetails[] = [
				'id_com' => $commande['id_com'],
				'date' => $commande['date'],
				'produits' => $produits,
				'total' => $totalCommande
			];
		}

		// Passer les informations à la vue
		$data['historiqueCommandes'] = $historiqueDetails;
		$data['pager'] = $pager->makeLinks($currentPage, $perPage, $totalCommandes, 'default_full'); // Générer les liens de pagination

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
