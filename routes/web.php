<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SepatuController;

use App\Http\Controllers\Penjualan\PenjualanController;
use App\Http\Controllers\Penjualan\PenjualanMemberController as PenjualanMember;
use App\Http\Controllers\Penjualan\DetailPenjualanController as DetailPenjualan;
use App\Http\Controllers\Penjualan\TempDetailPenjualanController as TempDetailPenjualan;

use App\Http\Controllers\Auth\UserController as LoginAdmin;
use App\Http\Controllers\Auth\MemberController as LoginMember;

use App\Http\Controllers\Profile\UserController as ProfileAdmin;
use App\Http\Controllers\Profile\MemberController as ProfileMember;

use App\Http\Controllers\Dashboard\UserController as DashboardAdmin;
use App\Http\Controllers\Dashboard\MemberController as DashboardMember;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginMember::class, 'index']); //untuk sekarang login, nnti landing page

Route::prefix('member')->controller(LoginMember::class)->group(function() {
    Route::get('/login', 'index')->name('login');
    Route::post('/postlogin', 'login');
    Route::get('/logout', 'logout');
});

Route::group(['prefix', 'admin'], function() {
    Route::controller(LoginAdmin::class)->group(function() {
        Route::get('/login', 'index')->name('login-admin');
        Route::post('/postlogin', 'login');
        Route::get('/logout', 'logout');
    });

    Route::middleware(['auth', 'level:Admin'])->group(function() {
        Route::prefix('profile')->controller(ProfileAdmin::class)->group(function() {
            Route::get('/', 'index');
            Route::post('/change', 'change');

            Route::get('/pass', 'indexPass');
            Route::post('/pass/change', 'changePass');
        });

        Route::prefix('user')->controller(UserController::class)->group(function() {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::post('/{id}/update', 'update');
            Route::get('/{id}/destroy', 'destroy');
            Route::get('/{id}/pass', 'indexPass');
            Route::post('/{id}/pass/change', 'changePass');
        });

        Route::prefix('member')->controller(MemberController::class)->group(function() {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::post('/{id}/update', 'update');
            Route::get('/{id}/destroy', 'destroy');
            Route::get('/{id}/pass', 'indexPass');
            Route::post('/{id}/pass/change', 'changePass');
        });

        Route::prefix('supplier')->controller(SupplierController::class)->group(function() {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::post('/{id}/update', 'update');
            Route::get('/{id}/destroy', 'destroy');
        });
    });

    Route::middleware(['auth', 'level:Admin,Kasir'])->group(function() {
        Route::get('/dashboard', [DashboardAdmin::class, 'index']);
        Route::prefix('sepatu')->controller(SepatuController::class)->group(function() {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::get('/{sepatu}', 'show');
            Route::post('/store', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::post('/{id}/update', 'update');
            Route::get('/{id}/destroy', 'destroy');
        });

        Route::prefix('tempdetail')->controller(TempDetailPenjualan::class)->group(function() {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::post('/{id}/update', 'update');
            Route::get('/{id}/destroy', 'destroy');
        });

        Route::prefix('detail')->controller(DetailPenjualan::class)->group(function() {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::post('/{id}/update', 'update');
            Route::get('/{id}/destroy', 'destroy');
        });

        Route::prefix('penjualan')->controller(PenjualanController::class)->group(function() {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::get('/{id}/cancel', 'cancel');
            Route::get('/{id}/detail', 'detail');
            Route::post('/{id}/update', 'update');
            Route::get('/{id}/destroy', 'destroy');
            Route::get('/{id}/struk', 'struk');
            // Route::get('/laporan', 'laporan');
            Route::post('/laporan', 'laporan');
        });
    });
});

Route::prefix('member')->middleware('auth:member')->group(function() {
    Route::get('/dashboard', [DashboardMember::class, 'index']);
    Route::prefix('profile')->controller(ProfileMember::class)->group(function() {
        Route::get('/', 'index');
        Route::post('/change', 'change');
        
        Route::get('/pass', 'indexPass');
        Route::post('/pass/change', 'changePass');
    });
    Route::prefix('penjualan')->controller(PenjualanMember::class)->group(function() {
        Route::get('/{id}/detail', 'detail');
        Route::get('/{id}/struk', 'struk');
    });
});
