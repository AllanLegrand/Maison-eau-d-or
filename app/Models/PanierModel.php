<?php
namespace App\Models;
use CodeIgniter\Model;
class PanierModel extends Model
{
	protected $table = 'panier';
	protected $primaryKey = ['id_prod', 'id_util'];
	protected $allowedFields = [
		'id_prod',
		'id_util',
		'qt'
	];

	public function ajouterPanier(array $data)
	{
		return $this->insert($data);
	}

	public function modifPanier(int $id_prod, int $id_util, array $data): bool
	{
		return $this->update($id_prod, $id_util, $data);
	}

	public function supprPanier(int $id_prod, int $id_util): bool
	{
		return $this->delete($id_prod, $id_util);
	}
}