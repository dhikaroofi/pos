<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseCRUDController
{
    public function __construct()
    {
        $model = new User;
        $this->validation = array(
            'name'     => 'required|',
            'email'     => 'required|',
            'password'     => 'required|',
        );
        parent::__construct($model,"User","users");
    }

    protected function sanitzedData(array $data){
        if (isset($data["password"])){
             $data["password"] = Hash::make($data["password"]);
        }
        return $data;
    }
    protected function validateBefore(Request $request): string{
        $checkExist = $this->model::where('email',$request->get('email'));
        if ($request->has("id")){
            $checkExist =  $checkExist->where("id","!=",$request->get("id"));
        }
        $checkExist =  $checkExist->count();
        if ($checkExist > 0){
            return "email sudah terpakai";
        }
        return "";
    }


}
