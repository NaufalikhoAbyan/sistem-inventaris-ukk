<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KategoriController;
use \App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', function () {
        return inertia('Index');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:web');

    Route::resource('/kategori', KategoriController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/barang-masuk', BarangMasukController::class);
    Route::resource('/barang-keluar', BarangKeluarController::class);
});
