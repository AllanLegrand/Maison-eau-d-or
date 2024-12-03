<?php
namespace App\Models;
use CodeIgniter\Model;
class FAQModel extends Model
{
	protected $table = 'faq';
	protected $primaryKey = 'id_faq';
	protected $allowedFields = [
		'id_faq',
		'txt'
	];

	public function ajouterFAQ(array $data)
	{
		return $this->insert($data);
	}

	public function modifFAQ(int $id_faq, array $data): bool
	{
		return $this->update($id_faq, $data);
	}

	public function supprFAQ(int $id_faq): bool
	{
		return $this->delete($id_faq);
	}
}