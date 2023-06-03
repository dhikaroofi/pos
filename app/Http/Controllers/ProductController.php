<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseCRUDController
{

    public function __construct()
    {
        $model = new Product;

        $this->validation = array(
            'category' => 'required',
            'name' => 'required',
            'unit' => 'required|alpha_dash',
            'stock' => 'required|integer',
            'selling_price' => 'required|integer',
            'selling_price_resellers' => 'required|integer',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        );
        parent::__construct($model, "Produk", "product");
    }

    protected function getFormData(array $param)
    {
        $categories = Category::select("id","name")->orderBy("name", "ASC")->get();
        $this->pageData["formData"]["categories"] = $categories;
    }

    public function actCreate(Request $request)
    {
        $validator = Validator::make($request->all(),
            $this->validation,
            $this->validationMessage,
        );


        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->messages());
        }
        $filename = "";
        try {
           if($request->has("image")){
               $image = $request->file('image');
               $filename = uniqid() . '.' . $image->getClientOriginalExtension();
               $request->file('image')->storeAs(
                   'public/images/product', $filename
               );
           }
            $filename = "images/product/".$filename;

            $validatedData = $validator->validated();

            $this->model::create(array(
                "name"=>$validatedData["name"],
                "category_id"=>$validatedData["category"],
                "unit"=>$validatedData["unit"],
                "selling_price"=>$validatedData["selling_price"],
                "selling_price_resellers"=>$validatedData["selling_price_resellers"],
                "stock"=>$validatedData["stock"],
                "image"=>$filename,
            ));
            return redirect()->back()->with('success', $this->pageData["title"] . " berhasil dibuat");
        }catch (\Exception $e){
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }


    public function actUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),
            $this->validation,
            $this->validationMessage,
        );


        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->messages());
        }
        $filename = "";
        try {
            if($request->has("image")){
                $image = $request->file('image');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $request->file('image')->storeAs(
                    'public/images/product', $filename
                );
            }

            $filename = "images/product/".$filename;

            $validatedData = $validator->validated();
            $result = $this->model::where("id",$request->get("id"))->first();
            if(!$result){
                return redirect()->back()->with('failed', $this->pageData["title"] . " tidak ditemukan");
            }
            $this->model::where("id",$request->get("id"))->update(array(
                "name"=>$validatedData["name"],
                "category_id"=>$validatedData["category"],
                "unit"=>$validatedData["unit"],
                "selling_price"=>$validatedData["selling_price"],
                "selling_price_resellers"=>$validatedData["selling_price_resellers"],
                "stock"=>$validatedData["stock"],
                "image"=>$filename,
            ));
            return redirect()->back()->with('success', $this->pageData["title"] . " berhasil dibuat");
        }catch (\Exception $e){
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

}
