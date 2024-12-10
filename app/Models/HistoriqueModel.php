<?php
namespace App\Models;
use CodeIgniter\Model;
class HistoriqueModel extends Model
{
	protected $table = 'historique';
	protected $primaryKey = ['id_com', 'id_prod'];
	protected $allowedFields = [
		'id_com',
		'id_prod',
		'qt'
	];

	public function ajouterHistorique(array $data)
	{
		return $this->insert($data);
	}

	public function modifHistorique(int $id_com, int $id_prod, array $data): bool
	{
		return $this->update($id_com, $id_prod, $data);
	}

	public function supprHistorique(int $id_com, int $id_prod): bool
	{
		return $this->delete($id_com, $id_prod);
	}

	public function isCommander(int $id_prod)
	{
		return $this->select('COUNT(*)')->where('id_prod', $id_prod)->doFirst()['count'];
	}
}