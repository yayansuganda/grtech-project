<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('login.view');
    }

    public function postlogin(Request $request){
        if (Auth::attempt($request->only('email', 'password'))) {
            if(Auth::user()->role == 'admin'){
                return redirect()->intended('/compani');
            }
        }
        $request->session()->flush();
        return redirect('/')->with('login_error', 'Wrong Email & Password');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->flush();
        return redirect('/');
    }
}
