<?php

namespace App\Controllers;

use App\Models\CategoriesModel;

class CategoriesController extends BaseController
{
    public function getCategories()
    {
        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->findAll();

        return $this->response->setJSON($categories);
    }
}