<?php
namespace App\Models;
use CodeIgniter\Model;
class PanierModel extends Model
{
	protected $table = 'panier';
	protected $primaryKey = ['id_prod', 'id_sess'];
	protected $allowedFields = [
		'id_prod',
		'id_sess',
		'qt'
	];

	public function ajouterPanier(array $data)
	{
		return $this->insert($data);
	}

	public function modifPanier(int $id_prod, string $id_sess, array $data): bool
	{
		return $this->update([$id_prod, $id_sess], $data);
	}

	public function supprPanier(int $id_prod, string $id_sess): bool
	{
		return $this->delete([$id_prod, $id_sess]);
	}
}