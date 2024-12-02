<?php
namespace App\Models;
use CodeIgniter\Model;
class ProduitsModel extends Model
{
	protected $table = 'produits';
	protected $primaryKey = 'id_prod';
	protected $allowedFields = [
		'id_prod',
		'nom',
		'prix',
		'description',
		'img_path',
		'actif'
	];

	public function ajouterProduits(array $data)
	{
		return $this->insert($data);
	}

	public function modifProduits(int $id_prod, array $data): bool
	{
		return $this->update($id_prod, $data);
	}

	public function supprProduits(int $id_prod): bool
	{
		return $this->delete($id_prod);
	}
}