<?php

use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\ObatController;
use App\Http\Controllers\Back\TenagaMedisController;
use App\Http\Controllers\Back\TransaksiController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\ReservasiController as AdminReservasiController; // Diperbaiki: Menggunakan Back (B besar)
use App\Http\Controllers\front\BerandaController;
use App\Http\Controllers\front\ReservasiController; // Controller Reservasi Frontend
use App\Models\TenagaMedis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ----------------------------------------------------
// ROUTE FRONTEND (Pengunjung)
// ----------------------------------------------------
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/beranda', [BerandaController::class, 'index']);

// Route Reservasi Pasien (Frontend)
Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');

Route::get('/tim-tenaga-medis', function () {
    $tenagaMedis = TenagaMedis::all();
    return view('front.tenaga-medis', compact('tenagaMedis'));
})->name('front.tenaga-medis');

Route::get('/baca-artikel/{slug}', [BerandaController::class, 'detailArtikel'])->name('artikel.detail');
Route::get('/obat', [BerandaController::class, 'semuaObat'])->name('obat.index');
Route::get('/katalog-obat', [BerandaController::class, 'semuaObat']);
Route::get('/tentang-klinik', function () {
    return view('front.tentang');
})->name('tentang.index');


// ----------------------------------------------------
// ROUTE BACKEND (Dashboard Admin)
// ----------------------------------------------------
Route::middleware(['auth'])->name('back.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Route khusus Admin untuk mengelola reservasi
    Route::get('reservasi', [AdminReservasiController::class, 'index'])->name('reservasi.index');
    Route::put('reservasi/{id}/status', [AdminReservasiController::class, 'updateStatus'])->name('reservasi.updateStatus');

    Route::resource('article', ArticleController::class);
    Route::get('/article/{id}', [ArticleController::class, 'show']);

    Route::resource('obat', ObatController::class);
    Route::get('/obat/{id}', [ObatController::class, 'show']);

    Route::resource('tenaga-medis', TenagaMedisController::class);
    Route::get('/tenaga-medis/{id}', [TenagaMedisController::class, 'show']);

    Route::get('/transaksi/export', [TransaksiController::class, 'exportExcel'])->name('transaksi.export');
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
    Route::resource('transaksi', TransaksiController::class);

    Route::resource('/users', UserController::class);
});

// File Manager & Auth
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
