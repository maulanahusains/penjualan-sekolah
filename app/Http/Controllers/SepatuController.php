<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Supplier;
use App\Models\Sepatu;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

class SepatuController extends Controller
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
            'image' => ':attribute Harus Diisi dengan Gambar',
        ];

        $this->attributes = [
            'nama_sepatu' => 'nama_sepatu',
            'id_supplier' => 'id_supplier',
        ];
    }

    public function index() {
        $sepatu = Sepatu::all();
        $supplier = Supplier::all();
        return view('home.admin.sepatu.index', compact('sepatu', 'supplier'));
    }
    
    public function create() {
        return view('home.admin.sepatu.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama_sepatu' => 'required|unique:sepatus|max:100',
            'id_supplier' => 'required',
            'merk' => 'required',
            'warna' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'photo' => 'required|image|mimes:jpg,png,jpeg,svg,gif|max:2048'
        ], $this->errMessages, $this->attributes);

        $imgName = Str::orderedUuid().'.'.$request->photo->extension();
        $request->photo->storeAs('public/shoeimg', $imgName);

        $validatedData['photo'] = $imgName;
        Sepatu::create($validatedData);
        return redirect('/sepatu');
    }

    public function show(Sepatu $sepatu) {
        return $sepatu;
    }

    public function edit($id) {
        $sepatu = Sepatu::find($id);
        $supplier = Supplier::all();
        return view('home.admin.sepatu.edit', compact('sepatu', 'supplier'));
    }

    public function update($id, Request $request) {
        $sepatu = Sepatu::find($id);
        $validatedData = $request->validate([
            'nama_sepatu' => 'required|max:100',
            'id_supplier' => 'required',
            'merk' => 'required',
            'warna' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
        ], $this->errMessages, $this->attributes);

        if($request->hasFile('photo')) {
            $imgName = Str::orderedUuid().'.'.$request->photo->extension();
            $request->photo->storeAs('public/shoeimg', $imgName);
            Storage::delete('public/shoeimg/'.$sepatu->photo);
            $validatedData["photo"] = $imgName;
            $sepatu->update($validatedData);
        } else {
            $imgName = $sepatu->photo;
            $validatedData["photo"] = $imgName;
            $sepatu->update($validatedData);
        }
        
        return redirect('/sepatu');
    }

    public function destroy($id) {
        DetailPenjualan::query()
        ->where('id_sepatu', $id)
        ->each(function($old) {
            Penjualan::where('no_penjualan', $old->no_penjualan)->each(function($old) { $old->delete(); });
            $old->delete();
        });
        $sepatu = Sepatu::find($id);
        Storage::delete('public/shoeimg/'.$sepatu->photo);
        $sepatu->delete();
        return redirect('/sepatu');
    }
}
