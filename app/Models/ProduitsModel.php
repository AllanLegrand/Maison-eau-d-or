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

	public function getTotalProduitsParCategorie(?int $idCat = null, bool $admin = false): int 
	{
		if(!$admin)
			$query = $this->where(['actif' => true]);
		else
			$query = $this;

		if ($idCat !== null) {
			$query->join('prodcat', 'produits.id_prod = prodcat.id_prod')
				->where('prodcat.id_cat', $idCat);
		}
		else {
			if($admin)
				return $this->select('*')->countAllResults();
			return $this->where(['actif' => !$admin])->select('*')->countAllResults();
		}

		return $query->countAllResults();
	}

	public function getProduitsParCategorie(?int $idCat = null, int $perPage = 0, int $offset = 0, bool $admin = false, ?string $sortField = null, ?string $sortDirection = null): array
	{
		if(!$admin)
			$query = $this->where(['actif' => true])->select('*');
		else
			$query = $this->select('*');

		if ($idCat !== null) {
			$query->join('prodcat', 'produits.id_prod = prodcat.id_prod')
				->where('prodcat.id_cat', $idCat);
		}

		// Appliquer le tri si spécifié
		if ($sortField && $sortDirection) {
			$query->orderBy($sortField, $sortDirection);
		}

		return $query->findAll($perPage ?: null, $offset);
	}


	public function getProduitById(int $id_prod)
	{
		return $this->where(['id_prod' => $id_prod, 'actif' => true])->first();
	}

	public function getProduitByFilter(string $nom_cat) {
		return $this->db->table('produits')->select('produits.*')
					->join('prodcat', 'prodcat.id_prod = produits.id_prod')
					->join('categories', 'categories.id_cat = prodcat.id_cat')
					->where('categories.nom', $nom_cat)
					->where(['actif' => true])
					->get()
					->getResultArray();
	}

	public function getProduitByNom(string $nomProd) {
		return $this->db->table('produits')->select('produits.*')
					->like('LOWER(produits.nom)', strtolower($nomProd), 'after')
					->where(['actif' => true])
					->get()
					->getResultArray();
	}
}
