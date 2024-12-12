<?php
namespace App\Models;
use CodeIgniter\Model;
class AproposModel extends Model
{
	protected $table = 'apropos';
	protected $primaryKey = 'id_pro';
	protected $allowedFields = [
		'id_pro',
		'msg'
	];

	public function ajouterApropos(array $data)
	{
		return $this->insert($data);
	}

	public function modifApropos(int $id_art, array $data): bool
	{
		return $this->update($id_art, $data);
	}

	public function supprApropos(int $id_art): bool
	{
		return $this->delete($id_art);
	}

	public function getApropos() {
		return $this->first();
	}
}