<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->pageData["title"] = "Laporan";
        $this->pageData["page"] = "reports";
        $this->pageData["keywordColumn"] = "name";
    }

    public function stock(Request $request)
    {
        $this->pageData["currentPage"] = "Laporan Stok Produk";
        $getProduct =  Product::select("*");
        if ($request->has("minStock")){
            $getProduct =  $getProduct->where("stock","<=",$request->get("minStock"));
        }

        $this->pageData["product"] = $getProduct->get();
        return view('pages.report.stock', $this->pageData);
    }

    public function transaction(Request $request)
    {

        $this->pageData["currentPage"] = "Laporan Penjualan Produk";


        $currentDate = Carbon::now();
        $startDate = $currentDate->startOfMonth();
        $endDate = $currentDate->endOfMonth();
        if ($request->has('submit')) {
            try {
                $startDate = Carbon::createFromFormat('Y-m-d', $request->get('startDate'));
                $endDate = Carbon::createFromFormat('Y-m-d',  $request->get('endDate'));
            }catch (\Exception  $e){
                return redirect()->back()->with('failed', $e->getMessage());
            }
        }

        $transaction  = DetailTransaction::select('product.name as name','detail_transaction.product_id','detail_transaction.created_at','detail_transaction.qty','detail_transaction.price')
            ->join('product', 'product.id', '=', 'detail_transaction.product_id')
            ->whereBetween('detail_transaction.created_at',[$startDate, $endDate])->get();
        $grouped = $transaction->groupBy('product_id')->map(function ($group) {
            $totalPrice = $group->sum('price') * $group->sum('qty');
            $totalQuantity = $group->sum('qty');
            $productName = $group->first()['name'];

            return ['name' => $productName,'total' => $totalPrice, 'qty' => $totalQuantity];
        });
        $this->pageData["transaction"] = $grouped;
        $this->pageData["startDate"] = $startDate;
        $this->pageData["endDate"] = $endDate;
        return view('pages.report.transaction', $this->pageData);
    }
}
