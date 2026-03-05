<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // routes/api.php atau routes/web.php
Route::post('/api/user/theme', [UserController::class, 'updateTheme'])->middleware('auth');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('user', UserController::class);
    Route::resource('kunjungan', KunjunganController::class);
    

    Route::get('laporan/bulanan', [LaporanController::class, 'bulanan'])->name('laporan.bulanan');
    Route::get('laporan/tahunan', [LaporanController::class, 'tahunan'])->name('laporan.tahunan');

    // Laporan - export Excel
    Route::get('laporan/bulanan/export/excel', [LaporanController::class, 'exportBulanan'])->name('laporan.bulanan.export');
    Route::get('laporan/tahunan/export/excel', [LaporanController::class, 'exportTahunan'])->name('laporan.tahunan.export');
    Route::resource('laporan', LaporanController::class);
});

require __DIR__.'/auth.php';

// Public Routes (Tanpa Login)
Route::get('/tamu', [KunjunganController::class, 'publicForm'])->name('kunjungan.publicForm');
Route::post('/tamu', [KunjunganController::class, 'publicStore'])->name('kunjungan.publicStore');
Route::get('/tamu/terima-kasih/{kode}', [KunjunganController::class, 'thankYou'])->name('kunjungan.thankYou');
