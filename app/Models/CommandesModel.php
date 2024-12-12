<?php
namespace App\Models;
use CodeIgniter\Model;
class CommandesModel extends Model
{
	protected $table = 'commandes';
	protected $primaryKey = 'id_com';
	protected $allowedFields = [
		'id_com',
		'id_util',
		'date',
		'adresselivraison',
		'modelivraison'
	];

	public function ajouterCommandes(array $data)
	{
		return $this->insert($data);
	}

	public function modifCommandes(int $id_com, array $data): bool
	{
		return $this->update($id_com, $data);
	}

	public function supprCommandes(int $id_com): bool
	{
		return $this->delete($id_com);
	}
}