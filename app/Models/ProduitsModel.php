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

	public function getTotalProduits(): int 
	{
		return $this->where(['actif' => true])->select('*')->countAllResults();
	}

	public function getProduitsPagines(int $perPage, int $offset = 0): array
	{
		return $this->where(['actif' => true])->select('*')->orderBy('id_prod', 'ASC')->findAll($perPage, $offset);
	}

	public function getProduitById(int $id_prod)
	{
		return $this->where(['id_prod' => $id_prod, 'actif' => true])->first();
	}

	public function getProduitByFilter(string $nom_cat) {
		return $this->join('prodcat', 'prodcat.id_prod = produits.id_prod')
					->join('categorie', 'categorie.id_cat = prodcat.id_cat')
					->where('prodcat.nom', $nom_cat)
					->get()
					->getResultArray();
	}
}
