<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class MemberController extends Controller
{
    public function __construct() {
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
        $user = Member::find(Auth()->User()->id);
        return view('home.profile.member.profile', compact('user'));
    }

    public function change(Request $request) {
        $user = Member::find(Auth()->User()->id);
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'alamat' => 'required',
            'no_telp' => 'required|numeric'
        ], $this->errMessages, $this->attributes);

        $user->update($validatedData);
        return redirect('/member/dashboard');
    }

    public function indexPass() {
        $user = Member::find(Auth()->User()->id);
        return view('home.profile.member.pass', compact('user'));
    }

    public function changePass(Request $request) {
        $user = Member::find(Auth()->User()->id);
        if(password_verify($request->old_pass, $user->password)) {
            $validatedData = $request->validate([
                'password' => 'required|min:8|max:255',
            ], $this->errMessages);
            $validatedData['password'] = bcrypt($validatedData['password']);

            $user->update($validatedData);
            return redirect('/member/dashboard')->with('success', 'Sukses mengubah password'); //PR
        }
        return redirect('/member/profile/pass')->with('error', 'Password tidak sama');
    }
}
