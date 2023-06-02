<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function __construct(){
        $this->pageData["title"] = "Transaksi";
        $this->pageData["page"] = "transaction";
    }

    public function index(){
        $this->pageData["currentPage"] = "Penjualan Barang";
        return view('pages.transaction.index',$this->pageData);
    }

    public function findProduct(){

    }

    public function addItemToCart(){

    }

    public function removeItemToCart(){

    }


}
