<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->pageData["title"] = "home";
        $this->pageData["page"] = "home";
    }


    public function index(Request $request){
        $this->pageData["currentPage"] = "index";
        return view("pages.home.index",$this->pageData);
    }
}
