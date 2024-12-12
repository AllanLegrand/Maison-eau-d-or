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

		$data['utilisateur'] = $utilisateurModel->find($userId);

		$perPage = 3;
		$currentPage = $this->request->getVar('page') ?? 1;
		$offset = ($currentPage - 1) * $perPage;

		$historiqueCommandes = $commandesModel
			->where('id_util', $userId)
			->orderBy('id_com', 'DESC')
			->findAll($perPage, $offset);

		$totalCommandes = $commandesModel->where('id_util', $userId)->countAllResults(); 

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

		$data['historiqueCommandes'] = $historiqueDetails;
		$data['pager'] = $pager->makeLinks($currentPage, $perPage, $totalCommandes, 'default_full');

		$admin = $session->get('isLoggedIn') && $utilisateurModel->isAdmin($userId);

		if( $admin ) {
			$historiqueCommandesGene = $commandesModel
				->orderBy('id_com', 'DESC')
				->findAll($perPage, $offset);
			
			$totalCommandesGene = $commandesModel->countAllResults();

			$historiqueDetailsGene = [];
			foreach($historiqueCommandesGene as $commandeGene){
				$historiqueModelGene = new HistoriqueModel();
				$produitsHistoriqueGene = $historiqueModelGene->where('id_com', $commandeGene['id_com'])->findAll();

				$produitsGene = [];
				$totalCommandeGene = 0;

				foreach($produitsHistoriqueGene as $produitHistoriqueGene){
					$produitsGene[] = [
						'id_prod' => $produit['id_prod'],
						'nom' => $produit['nom'],
						'prix' => $produit['prix'],
						'image' => base_url('assets/img/' . ($produit['img_path'] ?: 'default.png')),
						'quantite' => $produitHistorique['qt'],
					];

					$totalCommandeGene += $produit['prix'] * $produitHistorique['qt'];
					
				}

				$historiqueDetailsGene[] = [
					'id_com' => $commandeGene['id_com'],
					'date' => $commandeGene['date'],
					'produits' => $produitsGene,
					'total' => $totalCommandeGene
				];
			}

			$data['historiqueCommandesGene'] = $historiqueDetailsGene;
			$data['pagerGene'] = $pager->makeLinks($currentPage, $perPage, $totalCommandesGene, 'default_full');
		}

		$data['admin'] = $admin;
		
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

		$data['news'] = isset($data['news']) ? true : false;

		$rules = [
			'nom' => 'required|min_length[3]',
			'prenom' => 'required|min_length[3]',
			'adresse' => 'required|min_length[5]',
		];

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('error', 'Veuillez corriger les erreurs.');
		}
		
        $model->modifUtilisateurs($userId, $data);
		return redirect()->to('/profil');
    }

	public function supprInfo()
    {
        $session = session();
        $userId = $session->get('id_util');

        $prenom = $this->request->getPost('prenom');
        $nom = $this->request->getPost('nom');

        $UtilisateurModel = new UtilisateursModel();
        $UtilisateurModel->supprimerDonnees($userId);

		$session->destroy();
		helper('cookie');
        delete_cookie('ci_session');

        return redirect()->to('/Accueil');
    }
}
