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

class PenjualanMemberController extends Controller
{
    public function struk($id) {
        $penjualan = Penjualan::find($id);
        $today = Carbon::today();
        $tempdetail = DetailPenjualan::where('no_penjualan', '=', $penjualan->no_penjualan)->get();
        return view('home.member.penjualan.struk', compact('penjualan', 'today', 'tempdetail'));
    }

    public function detail($id) {
        $penjualan = Penjualan::find($id);
        $data = array(
            'detail' => DetailPenjualan::where('no_penjualan', $penjualan->no_penjualan)->get(),
            'carbon' => new Carbon,
            'penjualan' => $penjualan
        );

        return view('home.member.penjualan.detail', $data);
    }
}
