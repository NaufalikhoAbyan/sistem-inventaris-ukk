<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return inertia('Index');
})->name('dashboard');

Route::resource('/kategori', KategoriCOntroller::class);
