<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BaseCRUDController extends Controller
{
    protected Model $model;
    protected array $validation = array();
    protected array $validationMessage = array();

    public function __construct(Model $model, string $title, $page)
    {
        $this->model = $model;

        $this->pageData["title"] = $title;
        $this->pageData["page"] = $page;
    }


    public function index()
    {
        $this->getFormData(array());
        $this->pageData["currentPage"] = "List Data";
        $this->pageData["data"] = $this->model::paginate(10);
        return view("pages." . $this->pageData["page"] . ".index", $this->pageData);
    }

    public function showUpdateForm($id)
    {
        $this->getFormData(array());
        return view("pages." . $this->pageData["page"] . ".show", $this->pageData);
    }

    public function showCreateForm()
    {
        $this->getFormData(array());
        return view("pages." . $this->pageData["page"] . ".show", $this->pageData);
    }

    protected function getFormData(array $param)
    {
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

        try {
            $this->model::create($validator->validated());
            return redirect()->back()->with('success', $this->pageData["title"] . " berhasil dibuat");
        }catch (\Exception $e){
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function actUpdate(Request $request)
    {
        $validation = $this->validation;
        $validation[] = array(
            "id" => "required|numeric"
        );
        $validator = Validator::make($request->all(),
            $validation,
            $this->validationMessage
        );

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors());
        }

        try {
            $result = $this->model::where("id",$request->get("id"))->first();
            if(!$result){
                return redirect()->back()->with('failed', $this->pageData["title"] . " tidak ditemukan");
            }
            $this->model::where("id",$request->get("id"))->update($validator->validated());
            return redirect()->back()->with('success', $this->pageData["title"] . " berhasil di rubah");
        }catch (\Exception $e){
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function actDelete(Request $request)
    {
        $validator = Validator::make($request->all(),
            array(
                "id"=>"required|numeric"
            ),
        );

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors());
        }

        try {
            $count = $this->model::where("id",$request->get("id"))->count();
            if($count < 1){
                return redirect()->back()->with('failed', $this->pageData["title"] . " tidak ditemukan");
            }
            $this->model::where("id",$request->get("id"))->delete();
            return redirect()->back()->with('success', $this->pageData["title"] . " berhasil di hapus");
        }catch (\Exception $e){
            return redirect()->back()->with('failed', $e->getMessage());
        }

    }


}
