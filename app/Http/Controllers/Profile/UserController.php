<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            if(Auth::User()->level == 'Admin' || Auth::User()->level == 'Kasir') {
                return $next($request);
            }

            Auth::logout();
            return redirect('/login')->with('error', 'Anda Harus menjadi admin untuk Mengakses page tersebut! silahkan login kembali');
        });

        $this->errMessages = [
            'required' => ':attribute Wajib Diisi!',
            'min' => ':attribute Harus Diisi Minimal :min karakter!',
            'max' => ':attribute Harus Diisi Maximal :max karakter!',
            'unique' => ':attribute Tersebut Sudah Dipakai',
            'numeric' => ':attribute Harus Diisi dengan Angka',
            'date' => ':attribute Harus Diisi dengan Tanggal',
        ];

        $this->attributes = [
            'no_telp' => 'no_telp'
        ];
    }

    public function index() {
        $user = User::find(Auth()->User()->id);
        return view('home.profile.admin.profile', compact('user'));
    }

    public function change(Request $request) {
        $user = User::find(Auth()->User()->id);
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'level' => 'required'
        ], $this->errMessages);

        $user->update($validatedData);
        return redirect('/dashboard');
    }

    public function indexPass() {
        $user = User::find(Auth()->User()->id);
        return view('home.profile.admin.pass', compact('user'));
    }

    public function changePass(Request $request) {
        $user = User::find(Auth()->User()->id);
        if(password_verify($request->old_pass, $user->password)) {
            $validatedData = $request->validate([
                'password' => 'required|min:8|max:255',
            ], $this->errMessages);
            $validatedData['password'] = bcrypt($validatedData['password']);

            $user->update($validatedData);
            return redirect('/dashboard')->with('success', 'Sukses mengubah password'); //PR
        }
        return redirect('/profile/pass')->with('error', 'Password tidak sama');
    }
}
