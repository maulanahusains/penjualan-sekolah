<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sepatu;
use App\Models\Member;
use App\Models\Penjualan;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index() {
        $today = Carbon::today();
        $endDate = Carbon::today()->subDays(7);

        $total_sepatu = Sepatu::count();
        $total_member = Member::count();
        $total_supplier = Supplier::count();

        $penjualan = Penjualan::Select()
            ->orderBy('created_at', 'desc')
            ->limit(5)->get();

        $total_minggu = Penjualan::Select(Penjualan::raw('SUM(jumlah_bayar) as total_price'))
            ->whereBetween('tanggal_bayar', [$endDate, $today])
            ->first();

        $sepatu = Sepatu::all();
        $member = Member::all();
        return view('home.dashboard.dashboard-admin', compact('total_sepatu', 'total_member', 'total_supplier', 'penjualan', 'sepatu', 'member'), ['total_minggu' => $total_minggu]);
    }
}
