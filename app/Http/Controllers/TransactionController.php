<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->pageData["title"] = "Transaksi";
        $this->pageData["page"] = "transaction";
    }

    public function index(Request $request)
    {
        $this->pageData["currentPage"] = "Penjualan Barang";
        if ($request->has("keyword")) {
            $keyword = "%" . strtolower($request->get('keyword')) . "%";
            $this->pageData["product"] = Product::where('stock', '>=', 5)
                ->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('barcode', 'LIKE', '%' . $keyword . '%');
                })
                ->get();
        }

        $this->pageData["cart"] = Cart::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $this->pageData["transaction"] = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('pages.transaction.index', $this->pageData);
    }

    public function pay(Request $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $transaction = new Transaction();
            $transaction->customer_type = "non-reseller";
            $transaction->user_id = $user->id;
            $transaction->save();
            $totalItem = 0;
            $totalPrice = 0;

            $carts = Cart::where("user_id", $user->id)->get();
            if (count($carts) < 1) {
                return redirect()->back()->with('failed', "tidak ada produk dalam keranjang");
            }

            foreach ($carts as $item) {
                $totalPrice += $item->price * $item->qty;
                $totalItem += $item->qty;

                $detailTransaction = new DetailTransaction();
                $detailTransaction->product_id = $item->product_id;
                $detailTransaction->transaction_id = $transaction->id;
                $detailTransaction->unit = $item->product->unit;
                $detailTransaction->price = $item->price;
                $detailTransaction->qty = $item->qty;
                $exec = $detailTransaction->save();
                if (!$exec) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', "gagal transaksi");
                }
                $checkProduct = Product::where('id', $detailTransaction->product_id)->first();
                if (!$checkProduct) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', "gagal transaksi");
                }

                if (($checkProduct->stock - $checkProduct->qty) < 1) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', "stok tidak tersedia");
                }

                $checkProduct->stock = $checkProduct->stock - $item->qty;
                $execProduct = $checkProduct->save();
                if (!$execProduct) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', "gagal transaksi");
                }

            }
            $transaction->total_price = $totalPrice;
            $transaction->total_item = $totalItem;
            $transaction->save();
            if ($request->get("amount") < $totalPrice) {
                DB::rollBack();
                return redirect()->back()->with('failed', "jumlah bayar harus sesuai dengan total harga");
            }
            Cart::where('user_id', Auth::user()->id)->delete();
            DB::commit();
            return redirect()->route('transaction.index')->with('success', "transaksi berhasil");

        } catch (\Exception $e) {
            DB::Rollback();
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function cancelTransaction()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
        return redirect()->back()->with('success', "transaksi berhasil di batalkan");
    }

    public function print($id)
    {
        $this->pageData["transaction"] = DetailTransaction::where('transaction_id',$id)->get();
        return view('pages.transaction.print',$this->pageData);
    }

}
