
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KasirManagementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VariantController;
<<<<<<< HEAD
use App\Http\Controllers\StockController;
=======
use App\Http\Controllers\TransaksiController;
>>>>>>> 15714c4120d7a9ce6ed2b1533c3b23824cb3d4f8

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

// ======================================
// HALAMAN ADMIN
// ======================================

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
<<<<<<< HEAD
        Route::get('/stok', [StockController::class, 'index'])
            ->name('stok.index');
        Route::post('/stok/update', [StockController::class, 'updateStock'])
            ->name('stok.update');
=======

>>>>>>> 15714c4120d7a9ce6ed2b1533c3b23824cb3d4f8
        Route::resource('kasir', KasirManagementController::class)
            ->except(['show'])
            ->names('kasir');

        Route::patch('/kasir/{id}/status', [KasirManagementController::class, 'toggleStatus'])
            ->name('kasir.toggleStatus');
    });

// ======================================
// HALAMAN KASIR
// ======================================

Route::middleware(['auth', 'role:kasir'])
    ->prefix('kasir')
    ->name('kasir.')
    ->group(function () {

        // Dashboard Kasir
        Route::get('/dashboard', [KasirController::class, 'dashboard'])
            ->name('dashboard');

        // Transaksi Baru
        Route::get('/transaksi', [KasirController::class, 'transaksiBaru'])
            ->name('transaksi');

        // Riwayat Penjualan
        Route::get('/riwayat', [TransaksiController::class, 'index'])
            ->name('riwayat');
    });
