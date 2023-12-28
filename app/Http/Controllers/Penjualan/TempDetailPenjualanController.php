<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penjualan;
use App\Models\Sepatu;
use App\Models\Supplier;
use App\Models\TempDetailPenjualan;
use Illuminate\Support\Str;
use Closure;
use Carbon\Carbon;

class TempDetailPenjualanController extends Controller
{
    public function __construct() {
        $this->middleware(function(Request $request, Closure $next) {
            if(Auth::User()->level == 'Admin' || Auth::User()->level == 'Kasir') {
                return $next($request);
            }

            // if(Auth::User()->level == 'Kasir') {
            //     if(Str::contains(url()->current(), '/admin/penjualan') || Str::contains(url()->current(), '/admin/penjualan/store')) {
            //         return $next($request);
            //     }
            //     return redirect('/login');
            // }

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

    public function store(Request $request) {
        $validatedData = $request->validate([
            'id_sepatu' => 'required',
            'no_penjualan' => 'required',
            'qty' => 'required|numeric',
        ], $this->errMessages, $this->attributes);
        $sepatu = Sepatu::find($request->id_sepatu);

        if($request->qty > $sepatu->stok) {
            return redirect($request->back)->with('error', 'Qty Tidak bisa melebihi Stok!');
        }

        $validatedData['sub_total'] = $request->qty * $sepatu->harga;
        $sepatu->update(['stok' => $sepatu->stok - $request->qty]);
        TempDetailPenjualan::create($validatedData);
        return redirect($request->back)->with('success', 'Sukses Menambahkan Data!');
    }

    public function destroy($id) {
        $tempDetail = TempDetailPenjualan::find($id);
        $sepatu = Sepatu::find($tempDetail->id_sepatu);
        $sepatu->update([ 'stok' => $sepatu->stok + $tempDetail->qty]);
        $tempDetail->delete();
        return redirect(url()->previous())->with('success', 'Sukses Menghapus Data!');
    }
}
