<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

class MemberController extends Controller
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
        $member = Member::all();
        return view('home.admin.member.index', compact('member'));
    }
    
    public function create() {
        return view('home.admin.member.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|unique:members|max:100',
            'password' => 'required|min:8|max:255',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
        ], $this->errMessages, $this->attributes);
        $validatedData['password'] = bcrypt($validatedData['password']);

        Member::create($validatedData);
        return redirect('/member');
    }

    public function edit($id) {
        $member = Member::find($id);
        return view('home.admin.member.edit', compact('member'));
    }

    public function update($id, Request $request) {
        $member = Member::find($id);
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
        ], $this->errMessages, $this->attributes);

        $member->update($validatedData);
        return redirect('/member');
    }

    public function destroy($id) {
        Penjualan::query()
        ->where('id_member', $id)
        ->each(function($old) {
            DetailPenjualan::where('no_penjualan', $old->no_penjualan)->each(function($old) { $old->delete(); });
            $old->delete();
        });
        Member::find($id)->delete();
        return redirect('/member');
    }

    public function indexPass($id) {
        $member = Member::find($id);
        return view('home.admin.member.pass', compact('member'));
    }

    public function changePass($id, Request $request) {
        $user = Member::find($id);
        if(password_verify($request->old_pass, $user->password)) {
            $validatedData = $request->validate([
                'password' => 'required|min:8|max:255',
            ], $this->errMessages);
            $validatedData['password'] = bcrypt($validatedData['password']);

            $user->update($validatedData);
            return redirect('/member')->with('success', 'Sukses mengubah password'); //PR
        }
        return redirect('/member/'.$id.'/pass')->with('error', 'Password tidak sama');
    }
}
