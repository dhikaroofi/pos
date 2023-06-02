<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use  App\Http\Controllers\BaseCRUDController;

class CategoryController extends BaseCRUDController
{
    public function __construct()
    {
        $model = new Category;
        $this->validation = array(
            'name'     => 'required|'
        );
        parent::__construct($model,"kategori","category");
    }


}
