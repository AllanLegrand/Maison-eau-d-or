<?php
namespace App\Models;
use CodeIgniter\Model;
class FAQModel extends Model
{
	protected $table = 'faq';
	protected $primaryKey = 'id_faq';
	protected $allowedFields = [
		'id_faq',
		'reponse',
		'question'
	];

	public function ajouterFAQ(array $data)
	{
		return $this->insert($data);
	}

	public function modifFAQ(int $id_faq, array $data): bool
	{
		return $this->db->table('faq')->where('id_faq', $id_faq)->update($data);
	}

	public function supprFAQ(int $id_faq): bool
	{
		return $this->delete($id_faq);
	}

	public function getFAQ()
	{
		return $this->findAll();
	}
}