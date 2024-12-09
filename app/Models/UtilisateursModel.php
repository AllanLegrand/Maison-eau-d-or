<?php
namespace App\Models;
use CodeIgniter\Model;
class UtilisateursModel extends Model
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

	public function isSubscribed(int $id_util) : bool
	{
		return $this->select('news')
					->where('id_util', $id_util)->get()->getResultArray()[0]['news'];
	}

	public function isAdmin(int $id_util) : bool
	{
		return $this->select('admin')
					->where('id_util', $id_util)->get()->getResultArray()[0]['admin'] === 't';
	}
}