<?php
namespace App\Models;
use CodeIgniter\Model;
class CarrouselModel extends Model
{
	protected $table = 'carrousel';
	protected $primaryKey = 'id_car';
	protected $allowedFields = [
		'id_car',
		'titre',
		'img_path'
	];

	public function ajouterCarrousel(array $data)
	{
		return $this->insert($data);
	}

	public function modifCarrousel(int $id_art, array $data): bool
	{
		return $this->update($id_art, $data);
	}

	public function supprCarrousel(int $id_art): bool
	{
		return $this->delete($id_art);
	}
}