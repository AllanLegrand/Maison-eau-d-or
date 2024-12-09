<?php
namespace App\Models;
use CodeIgniter\Model;
class ProdCatModel extends Model
{
	protected $table = 'prodcat';
	protected $useAutoIncrement = false;
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
	public function insertComposite(array $data)
	{
		return $this->db->table($this->table)->insert($data);
	}
	
	public function supprProdCat(int $id_prod, int $id_cat): bool
	{
		return $this->delete($id_prod, $id_cat);
	}

	public function getProdCatDictionary(): array
	{
		$results = $this->findAll();
		$dictionary = [];

		foreach ($results as $row) {
			// Si la clé id_prod n'existe pas encore, on l'initialise avec un tableau vide
			if (!isset($dictionary[$row['id_prod']])) {
				$dictionary[$row['id_prod']] = [];
			}

			// Ajouter id_cat à la liste des catégories pour ce produit
			$dictionary[$row['id_prod']][] = $row['id_cat'];
		}

		return $dictionary;
	}

	public function reintialiseProdCat($id_prod)
	{
		return $this->where('id_prod', $id_prod)->delete();
	}

}