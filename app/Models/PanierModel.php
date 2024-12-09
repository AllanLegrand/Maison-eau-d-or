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
		$this->db->query("
		INSERT INTO panier (id_prod, id_sess, qt) 
		VALUES (:id_prod:, :id_sess:, :qt:) 
		", $data);
	}

	public function modifPanier(int $id_prod, string $id_sess, array $data): bool
	{
		return $this->update([$id_prod, $id_sess], $data);
	}

	public function supprPanier(int $id_prod, string $id_sess): bool
	{
		return $this->delete([$id_prod, $id_sess]);
	}

	public function migrerPanierVersUtilisateur(string $idSess, int $idUtil)
	{
		$idUtil = (string)$idUtil;
		$panier = $this->where('id_sess', $idSess)->findAll();

		if (!empty($panier)) {
			foreach ($panier as $item) {
				$existing = $this->where('id_prod', $item['id_prod'])
								->where('id_sess', $idUtil)
								->first();

				if ($existing) {
					$newQt = $existing['qt'] + $item['qt'];
					$this->where(['id_prod' => $item['id_prod'], 'id_sess' => $idUtil])
						->set(['qt' => $newQt])
						->update();
				} else {
					$this->db->table($this->table)->insert([
						'id_prod' => $item['id_prod'],
						'id_sess' => $idUtil,
						'qt' => $item['qt']
					]);
				}
			}

			$this->where('id_sess', $idSess)->delete();
		}
	}
}