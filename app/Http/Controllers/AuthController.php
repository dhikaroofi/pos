<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index(){
        if (Auth::check()){
            return redirect('/');
        }
        return view('layouts.login');
    }

    public function actLogin(Request $request){
        if (Auth::check()){
            return redirect('/');
        }

        $validator = Validator::make($request->all(),[
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed',"tidak di izinkan 2");
        }

        if (Auth::attempt($validator->validated())) {
            $request->session()->regenerate();
            return redirect()->intended('');
        }

        return redirect()->back()->with('failed',"username dan password salah");
    }


    public function actLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
