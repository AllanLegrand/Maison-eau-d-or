<?php
namespace App\Models;
use CodeIgniter\Model;
class ProdCatModel extends Model
{
	protected $table = 'prodcat';
	protected $primaryKey = ['id_prod','id_cat'];
	protected $allowedFields = ['id_prod', 'id_cat'];

	public function ajouterProdCat(array $data)
	{
		return $this->insert($data);
	}
/*
	public function modifProdCat(int $id_prod, int $id_cat, array $data): bool
	{
		return $this->update($id_prod, $id_cat, $data);
	}
*/
	public function supprProdCat(int $id_prod, int $id_cat): bool
	{
		return $this->delete($id_prod, $id_cat);
	}
}