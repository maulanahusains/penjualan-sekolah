<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class UserController extends Controller
{
    public function index() {
        return view('home.auth.login-admin');
    }

    public function login(Request $request) {
        if(Auth::guard('web')->attempt($request->only('username', 'password'))) {
            return redirect('/dashboard');
        }
        return redirect('/login')->with('error', 'Username / Password salah!');
    }
    
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
