<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            if(Auth::User()->level == 'Admin') {
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
        $user = User::all();
        return view('home.admin.user.index', compact('user'));
    }
    
    public function create() {
        return view('home.admin.user.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|unique:users|max:100',
            'password' => 'required|min:8|max:255',
            'level' => 'required'
        ], $this->errMessages);
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        return redirect('/user');
    }

    public function edit($id) {
        $user = User::find($id);
        return view('home.admin.user.edit', compact('user'));
    }

    public function update($id, Request $request) {
        $user = User::find($id);
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'level' => 'required'
        ], $this->errMessages);

        $user->update($validatedData);
        return redirect('/user');
    }

    public function destroy($id) {
        Penjualan::query()
            ->where('id_kasir', $id)
            ->each(function($old) {
                DetailPenjualan::where('no_penjualan', $old->no_penjualan)->get()->delete();
                $old->delete();
            });
        User::find($id)->delete();
        return redirect('/user');
    }

    public function indexPass($id) {
        $user = User::find($id);
        return view('home.admin.user.pass', compact('user'));
    }

    public function changePass($id, Request $request) {
        $user = User::find($id);
        if(password_verify($request->old_pass, $user->password)) {
            $validatedData = $request->validate([
                'password' => 'required|min:8|max:255',
            ], $this->errMessages);
            $validatedData['password'] = bcrypt($validatedData['password']);

            $user->update($validatedData);
            return redirect('/user')->with('success', 'Sukses mengubah password'); //PR
        }
        return redirect('/user/'.$id.'/pass')->with('error', 'Password tidak sama');
    }
}
