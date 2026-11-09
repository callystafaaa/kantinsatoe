<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PesananKantinController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'beranda')->name('beranda');
Route::view('/pilih-mode', 'pilih-mode')->middleware('auth:kantin')->name('pilih.mode');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
Route::post('/daftar', [AuthController::class, 'register'])->name('register.proses');

Route::middleware('auth:pembeli')->name('pembeli.')->group(function () {
    Route::get('/menu', [PesananController::class, 'menu'])->name('menu');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan', [PesananController::class, 'riwayat'])->name('pesanan.riwayat');
    Route::get('/pesanan/{id}', [PesananController::class, 'detail'])->name('pesanan.detail');
});

Route::middleware('auth:kantin')->prefix('kantin')->name('kantin.')->group(function () {
    Route::get('/dashboard', [PesananKantinController::class, 'index'])->name('dashboard');
    Route::post('/pesanan/{id}/status', [PesananKantinController::class, 'ubahStatus'])->name('pesanan.status');
    Route::resource('produk', ProdukController::class)->except('show');
});
