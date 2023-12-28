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

class MemberController extends Controller
{
    public function index() {
        $penjualan = Penjualan::Select()
            ->where('id_member', Auth::User()->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)->get();
        return view('home.dashboard.dashboard-member', compact('penjualan'));
    }
}
