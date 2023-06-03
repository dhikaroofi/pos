<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function __construct(){
        $this->pageData["title"] = "Transaksi";
        $this->pageData["page"] = "transaction";
    }

    public function index(Request $request){
        $this->pageData["currentPage"] = "Penjualan Barang";
        if ($request->has("keyword")){
            $keyword = "%".$request->get('keyword')."%";
            $this->pageData["product"] = Product::where('stock','>=',5)
                ->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('barcode', 'LIKE', '%' . $keyword . '%');
                })
                ->get();
        }

        $this->pageData["cart"] = Cart::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('pages.transaction.index',$this->pageData);
    }

    public function pay(Request $request){

    }



}
