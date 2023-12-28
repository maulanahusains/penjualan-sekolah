<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class MemberController extends Controller
{
    public function index() {
        return view('home.auth.login-member');
    }

    public function login(Request $request) {
        if(Auth::guard('member')->attempt($request->only('username', 'password'))) {
            return redirect('/member/dashboard');
        }
        return redirect('/member/login')->with('error', 'Username / Password salah!');
    }
    
    public function logout() {
        Auth::logout();
        return redirect('/member/login');
    }
}
