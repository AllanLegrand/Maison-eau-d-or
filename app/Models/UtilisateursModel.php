<?php
namespace App\Models;
use CodeIgniter\Model;
class Utilisateurs extends Model
{
	protected $table = 'utilisateurs';
	protected $primaryKey = 'id_util';
	protected $allowedFields = [
		'id_util',
		'nom',
		'prenom',
		'mdp',
		'rst_tkn',
		'rst_tkn_exp',
		'email',
		'adresse',
		'admin',
		'news',
		'created_at'
	];

	public function ajouterUtilisateurs(array $data)
	{
		return $this->insert($data);
	}

	public function modifUtilisateurs(int $id_util, array $data): bool
	{
		return $this->update($id_util, $data);
	}

	public function supprUtilisateurs(int $id_util): bool
	{
		return $this->delete($id_util);
	}
}