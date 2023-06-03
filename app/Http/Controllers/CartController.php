<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function subtractItem(Request $request){
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(),
            array(
                'product_id' => 'required',
            ),
        );

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->messages());
        }

        $data = $validator->validated();

        try {
            $checkProduct = Product::where('id',$data["product_id"])->where('stock','>=',1)->first();
            if (!$checkProduct){
                return redirect()->back()->with('failed', "stok tidak tersedia");
            }
            $find = Cart::where('user_id',$id)
                ->where('product_id',$data["product_id"])->first();
            if (!$find){
                return redirect()->back()->with('failed', "produk belum ditambahkan");
            }
            if ( ($find->qty - 1) < 1){
                $find->delete();
                return redirect()->back()->with('success',  "Produk berhasil dikurangi");
            }
            $find->qty = $find->qty - 1;
            $find->save();
            return redirect()->back()->with('success',  "Produk berhasil dikurangi");
        }catch (\Exception $e){
            return redirect()->back()->with('failed', $e->getMessage());
        }

    }


    public function addItem(Request $request){
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(),
            array(
                'product_id' => 'required',
//                'qty' => 'required|integer',
            ),
        );
        $data = $validator->validated();
        try {
            $checkProduct = Product::where('id',$data["product_id"])->where('stock','>=',1)->first();
            if (!$checkProduct){
                return redirect()->back()->with('failed', "stok tidak tersedia");
            }
            $find = Cart::where('user_id',$id)
                ->where('product_id',$data["product_id"])->first();
            if (!$find){
                $cart = new Cart();
                $cart->product_id = $data["product_id"];
                $cart->qty = 1;
                $cart->price = $checkProduct->selling_price;
                $cart->user_id = $id;
                $cart->save();
            }else{
                $find->qty = $find->qty + 1;
                $find->save();
            }
            return redirect()->back()->with('success', $this->pageData["title"] . " berhasil ditambahkan");
        }catch (\Exception $e){
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
