<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penjualan;
use App\Models\Sepatu;
use App\Models\Member;
use Illuminate\Support\Str;
use Closure;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function __construct() {
        $this->middleware(function(Request $request, Closure $next) {
            if(Auth::User()->level == 'Admin') {
                return $next($request);
            }

            if(Auth::User()->level == 'Kasir') {
                if(Str::contains(url()->current(), '/admin/penjualan') || Str::contains(url()->current(), '/admin/penjualan/store')) {
                    return $next($request);
                }
                return redirect('/login');
            }

            Auth::logout();
            return redirect('/login')->with('error', 'Anda Harus menjadi admin untuk Mengakses page tersebut! silahkan login kembali');
        });

        $this->errMessages = [
            'required' => ':attribute Wajib Diisi!',
            'min' => ':attribute Harus Diisi Minimal :min karakter!',
            'max' => ':attribute Hanya Bisa Diisi :max angka saja',
            'unique' => ':attribute Tersebut Sudah Dipakai',
            'numeric' => ':attribute Harus Diisi dengan Angka',
            'date' => ':attribute Harus Diisi dengan Tanggal',
        ];

        $this->attributes = [
            'id_sepatu' => 'id_sepatu',
            'id_member' => 'id_member',
            'id_kasir' => 'id_kasir',
            'tanggal_bayar' => 'tanggal_bayar',
            'jumlah_bayar' => 'jumlah_bayar',
        ];
    }

    public function index() {
        $penjualan = Penjualan::all();
        $sepatu = Sepatu::all();
        $member = Member::all();
        return view('home.admin.penjualan.index', compact('penjualan', 'sepatu', 'member'));
    }

    public function create() {
        return view('home.admin.penjualan.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'id_sepatu' => 'required',
            'id_member' => 'required',
            'id_kasir' => 'required',
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|numeric',
        ], $this->errMessages, $this->attributes);

        Penjualan::create($validatedData);
        return redirect('/penjualan');
    }

    public function edit($id) {
        $penjualan = Penjualan::find($id);
        $sepatu = Sepatu::all();
        $member = Member::all();
        return view('home.admin.penjualan.edit', compact('penjualan', 'sepatu', 'member'));
    }

    public function update($id, Request $request) {
        $penjualan = Penjualan::find($id);
        $validatedData = $request->validate([
            'id_sepatu' => 'required',
            'id_member' => 'required',
            'id_kasir' => 'required',
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|numeric',
        ], $this->errMessages, $this->attributes);

        $penjualan->update($validatedData);
        return redirect('/penjualan');
    }

    public function destroy($id) {
        Penjualan::find($id)->delete();
        return redirect('/penjualan');
    }

    public function laporan(Request $request) {
        dd($request);
        // $awalBulan = Carbon::today()->setMonth(Carbon::today()->month - 1);
        // $today = Carbon::today();

        // $penjualan = Penjualan::Select()
        //     ->whereBetween('tanggal_bayar', [$awalBulan, $today])
        //     ->get();
        // return view('home.admin.penjualan.laporan', compact('penjualan', 'today', 'awalBulan'));
    }

    public function struk($id) {
        $penjualan = Penjualan::find($id);
        $today = Carbon::today();
        return view('home.admin.penjualan.struk', compact('penjualan', 'today'));
    }
}
