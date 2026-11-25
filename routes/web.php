<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KasirManagementController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\StockController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Halaman Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');
        Route::resource('produk', ProductController::class)
            ->except(['show'])
            ->names('produk');
        Route::resource('kategori', CategoryController::class)
            ->except(['show'])
            ->names('kategori');
        Route::resource('varian', VariantController::class)
            ->except(['show'])
            ->names('varian');
        Route::get('/stok', [StockController::class, 'index'])
            ->name('stok.index');
        Route::post('/stok/update', [StockController::class, 'updateStock'])
            ->name('stok.update');
        Route::resource('kasir', KasirManagementController::class)
            ->except(['show'])
            ->names('kasir');
        Route::patch('/kasir/{id}/status', [KasirManagementController::class, 'toggleStatus'])
            ->name('kasir.toggleStatus');
    });

// Halaman Kasir
Route::middleware(['auth', 'role:kasir'])
    ->prefix('kasir')
    ->name('kasir.')
    ->group(function () {

        Route::get('/dashboard', [KasirController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/transaksi', [KasirController::class, 'transaksiBaru'])
            ->name('transaksi');

    });


#route transaksi controller
  Route::middleware(['auth'])->group(function () {

    Route::get('/transaksi', [TransaksiController::class, 'index'])
        ->name('transaksi.index');

});


