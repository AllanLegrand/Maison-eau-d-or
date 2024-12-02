<?php
namespace App\Models;
use CodeIgniter\Model;
class CategoriesModel extends Model
{
	protected $table = 'categories';
	protected $primaryKey = 'id_cat';
	protected $allowedFields = [
		'id_cat',
		'nom'
	];

	public function ajouterCategories(array $data)
	{
		return $this->insert($data);
	}

	public function modifCategories(int $id_cat, array $data): bool
	{
		return $this->update($id_cat, $data);
	}

	public function supprCategories(int $id_cat): bool
	{
		return $this->delete($id_cat);
	}
}