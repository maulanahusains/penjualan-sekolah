<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Sepatu;

class SupplierController extends Controller
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
            'nama_supplier' => 'nama_supplier',
            'nama_perusahaan' => 'nama_perusahaan',
        ];
    }

    public function index() {
        $supplier = Supplier::all();
        return view('home.admin.supplier.index', compact('supplier'));
    }
    
    public function create() {
        return view('home.admin.supplier.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|unique:suppliers|max:100',
            'nama_perusahaan' => 'required|max:100',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
        ], $this->errMessages, $this->attributes);

        Supplier::create($validatedData);
        return redirect('/supplier');
    }

    public function edit($id) {
        $supplier = Supplier::find($id);
        return view('home.admin.supplier.edit', compact('supplier'));
    }

    public function update($id, Request $request) {
        $supplier = Supplier::find($id);
        $validatedData = $request->validate([
            'nama_supplier' => 'required|max:100',
            'nama_perusahaan' => 'required|max:100',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
        ], $this->errMessages, $this->attributes);

        $supplier->update($validatedData);
        return redirect('/supplier');
    }

    public function destroy($id) {
        Sepatu::query()
        ->where('id_supplier', $id)
        ->each(function($old) {
            DetailPenjualan::query()
                ->where('id_sepatu', $old->id)
                ->each(function($old) {
                    Penjualan::where('no_penjualan', $old->no_penjualan)->each(function($old) { $old->delete(); });
                    $old->delete();
                });
            $old->delete();
        });
        Supplier::find($id)->delete();
        return redirect('/supplier');
    }
}
