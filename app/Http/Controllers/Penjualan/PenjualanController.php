<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penjualan;
use App\Models\Sepatu;
use App\Models\Member;
use App\Models\Diskon;
use App\Models\Supplier;
use App\Models\TempDetailPenjualan;
use App\Models\DetailPenjualan;
use Illuminate\Support\Str;
use Closure;
use Carbon\Carbon;

class PenjualanController extends Controller
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

    public function index() {
        $penjualan = Penjualan::all();
        $sepatu = Sepatu::all();
        $member = Member::all();
        return view('home.admin.penjualan.index', compact('penjualan', 'sepatu', 'member'));
    }

    public function create() {
        $no_penjualan = IDGenerator(new Penjualan, 'no_penjualan', 4, 'SB');
        $data = array(
            'penjualan' => Penjualan::all(),
            'member' => Member::all(),
            'sepatu' => Sepatu::where('stok', '>', 0)->get(),
            'diskon' => Diskon::find(1),
            'no_penjualan' => $no_penjualan,
            'tempdetail' => TempDetailPenjualan::where('no_penjualan', $no_penjualan)->get()
        );
        return view('home.admin.penjualan.create', $data);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'id_member' => 'required',
            'jumlah_bayar' => 'required|numeric',
        ], $this->errMessages, $this->attributes);
        $request['tanggal_bayar'] = Carbon::createFromFormat('d/M/Y', $request->tanggal_bayar)->format('Y-m-d');

        if($request->kembalian <= 0) {
            return redirect('/penjualan/create')->with('error', 'Uang pembeli tidak bisa kurang dari jumlah bayar!');
        }

        TempDetailPenjualan::query()
            ->where('no_penjualan', $request->no_penjualan)
            ->each(function($old) {
                $new = $old->replicate();
                $new->setTable('detail_penjualans');
                $new->save();

                $old->delete();
            });
        Penjualan::create($request->except(['_token']));
        return redirect('/penjualan')->with('success', 'Sukses Menambahkan Transaksi');
    }

    public function getArrLength($arr) {
        $v = 0;
        foreach($arr as $s) {
            $v += 1;
        }
        return $v;
    }


    public function edit($id) {
        $penjualan = Penjualan::find($id);

        DetailPenjualan::query()
            ->where('no_penjualan', $penjualan->no_penjualan)
            ->each(function($old) {
                $new = $old->replicate();
                $new->setTable('temp_detail_penjualans');
                $new->save();

                $old->delete();
            });
        
        $data = array(
            'penjualan' => $penjualan,
            'member' => Member::all(),
            'sepatu' => Sepatu::all(),
            'diskon' => Diskon::find(1),
            'carbon' => new Carbon,
            'no_penjualan' => $penjualan->no_penjualan,
            'tempdetail' => TempDetailPenjualan::where('no_penjualan', $penjualan->no_penjualan)->get()
        );

        return view('home.admin.penjualan.edit', $data);
    }

    public function cancel($id) {
        $penjualan = Penjualan::find($id);
        TempDetailPenjualan::query()
            ->where('no_penjualan', $penjualan->no_penjualan)
            ->each(function($old) {
                $new = $old->replicate();
                $new->setTable('detail_penjualans');
                $new->save();

                $old->delete();
            });
        return redirect('/penjualan');
    }

    public function update($id, Request $request) {
        $penjualan = Penjualan::find($id);
        $validatedData = $request->validate([
            'id_member' => 'required',
            'jumlah_bayar' => 'required|numeric',
        ], $this->errMessages, $this->attributes);
        $request['tanggal_bayar'] = $penjualan->tanggal_bayar;

        if($request->kembalian <= 0) {
            return redirect($request->back)->with('error', 'Uang pembeli tidak bisa kurang dari jumlah bayar!');
        }

        DetailPenjualan::query()->where('no_penjualan', $penjualan->no_penjualan)->each(function($data) {$data->delete();});

        TempDetailPenjualan::query()
            ->where('no_penjualan', $penjualan->no_penjualan)
            ->each(function($old) {
                $new = $old->replicate();
                $new->setTable('detail_penjualans');
                $new->save();

                $old->delete();
            });

        $penjualan->update($request->except(['_token']));
        return redirect('/penjualan')->with('success', 'Sukses Mengubah Data!');
    }

    public function destroy($id) {
        $penjualan = Penjualan::find($id);
        DetailPenjualan::query()
            ->where('no_penjualan', $penjualan->no_penjualan)
            ->each(function($old) {
                $sepatu = Sepatu::find($old->id_sepatu);
                $sepatu->update([ 'stok' => $sepatu->stok + $old->qty ]);
                $old->delete();
            });
        $penjualan->delete();
        return redirect('/penjualan');
    }

    public function laporan(Request $request) {
        $awalLaporan = Carbon::createFromFormat('Y-m-d', $request->laporanmulai);
        $akhirLaporan = Carbon::createFromFormat('Y-m-d', $request->laporanselesai);
        $today = Carbon::today();
        $penjualan = Penjualan::Select()
            ->whereBetween('tanggal_bayar', [$request->laporanmulai, $request->laporanselesai])
            ->get();
        if($this->getArrLength($penjualan) == 0) {
            return redirect(url()->previous())->with('error', 'Tidak Ada data transaksi di rentan waktu tersebut!');
        }
        return view('home.admin.penjualan.laporan', compact('penjualan', 'today', 'awalLaporan', 'akhirLaporan'));
    }

    public function struk($id) {
        $penjualan = Penjualan::find($id);
        $today = Carbon::today();
        $tempdetail = DetailPenjualan::where('no_penjualan', '=', $penjualan->no_penjualan)->get();
        return view('home.admin.penjualan.struk', compact('penjualan', 'today', 'tempdetail'));
    }

    public function detail($id) {
        $penjualan = Penjualan::find($id);
        $data = array(
            'detail' => DetailPenjualan::where('no_penjualan', $penjualan->no_penjualan)->get(),
            'carbon' => new Carbon,
            'penjualan' => $penjualan
        );

        return view('home.admin.penjualan.detail', $data);
    }
}
