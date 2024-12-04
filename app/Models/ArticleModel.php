<?php
namespace App\Models;
use CodeIgniter\Model;
class ArticleModel extends Model
{
	protected $table = 'article';
	protected $primaryKey = 'id_art';
	protected $allowedFields = [
		'id_art',
		'titre',
		'msg',
		'img_path',
		'date'
	];

	public function ajouterArticle(array $data)
	{
		return $this->insert($data);
	}

	public function modifArticle(int $id_art, array $data): bool
	{
		return $this->update($id_art, $data);
	}

	public function supprArticle(int $id_art): bool
	{
		return $this->delete($id_art);
	}

	public function getPaginatedArticles(int $perPage)
	{
		return $this->select('id_art, msg, titre, img_path, to_char(date, \'DD TMMonth YYYY, HH24:MI\') AS date')->paginate($perPage);
	}
}