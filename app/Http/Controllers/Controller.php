<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected array $pageData =  array(
        "page"=>"",
        "title" => "",
        "currentPage" => "",
        "data"=>array(),
        "formData"=>array(),
    );


    use AuthorizesRequests, ValidatesRequests;
}

