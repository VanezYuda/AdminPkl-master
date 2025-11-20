<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/suppliers', function () {
    return view('suppliers.index');
})->name('supplier');

Route::resource('suppliers', SupplierController::class);
Route::resource('kategori', KategoriController::class);

// Halaman login (GET)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');

// Proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

// Halaman index (setelah login)
Route::get('/index', function () {
    if (!session()->has('user')) {   // cek session yang benar
        return redirect()->route('login');
    }

    return view('index');
})->name('index');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
