<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KategoriController;
use \App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return inertia('Index');
})->name('dashboard');

Route::resource('/kategori', KategoriController::class);
Route::resource('/barang', BarangController::class);
Route::resource('/barang-masuk', BarangMasukController::class);
Route::resource('/barang-keluar', BarangKeluarController::class);
