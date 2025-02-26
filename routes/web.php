<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ShowController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('dashboard/check', [PembayaranController::class, 'index'])->name('dashboard.check');
Route::get('dashboard/detaile/{id}', [ShowController::class, 'showTuition'])->name('pembayaran.showTuition');
// Route::put('dashboard/petugas/{id}', [SiswaController::class, 'update'])->name('dashboard.update');


Auth::routes();

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard/admin', [DashboardController::class, 'adminHome'])->name('dashboard.admin');
});
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('dashboard/petugas', [DashboardController::class, 'petugasHome'])->name('dashboard.petugas');
});
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('dashboard/spp', [DashboardController::class, 'siswaHome'])->name('dashboard');
});

Route::resource('dashboard', SiswaController::class);
Route::resource('pembayaran', PembayaranController::class);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');