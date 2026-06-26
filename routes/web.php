<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Developer\DeveloperController; 
use App\Http\Controllers\Kasir\DashboardController as KasirDashboardController;
use App\Http\Controllers\Kasir\ReportController as KasirReportController;
use App\Http\Controllers\Kasir\TransactionController as KasirTransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Kasir\CashierController;

/*
|--------------------------------------------------------------------------
| Rute Publik
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('landing'); });
Route::get('/fitur', function () { return view('fitur'); });
Route::get('/harga', function () { return view('harga'); });
Route::get('/kontak', function () { return view('kontak'); });
Route::post('/kontak/kirim', [ContactController::class, 'kirimPesan'])->name('kontak.kirim');

/*
|--------------------------------------------------------------------------
| Rute Autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| KELOMPOK RUTE DEVELOPER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Developer']) 
    ->prefix('developer')
    ->name('developer.')
    ->group(function () {
        Route::get('/', [DeveloperController::class, 'index'])->name('dashboard');
        Route::post('/register-admin', [DeveloperController::class, 'storeAdmin'])->name('register.admin.submit');
        Route::put('/update-admin/{id}', [DeveloperController::class, 'updateAdmin'])->name('update.admin');
        Route::delete('/delete-admin/{id}', [DeveloperController::class, 'destroyAdmin'])->name('delete.admin');
        Route::get('/transactions', [DeveloperController::class, 'transactions'])->name('transactions');
        Route::get('/transactions/export-pdf', [DeveloperController::class, 'exportPdf'])->name('transactions.pdf');
    });

/*
|--------------------------------------------------------------------------
| KELOMPOK RUTE ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Halaman Dashboard Utama
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // MENGGUNAKAN RESOURCE UNTUK KASIR (Otomatis handle index, store, update, destroy)
        // Rute manual AdminDashboardController sudah dihapus agar tidak tabrakan
        Route::resource('cashiers', CashierController::class)->names('cashiers');

        // Rute untuk Kelola Produk
        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
        Route::put('/products/{productId}', [AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{productId}', [AdminProductController::class, 'destroy'])->name('products.destroy');
        
        // Rute untuk Laporan
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::delete('/reports/{id}', [AdminReportController::class, 'destroy'])->name('reports.destroy');
        
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    });

/*
|--------------------------------------------------------------------------
| KELOMPOK RUTE KASIR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir'])
    ->prefix('kasir')
    ->name('kasir.')
    ->group(function () {
        Route::get('/', [KasirDashboardController::class, 'index'])->name('dashboard');
        Route::get('/transactions/create', [KasirTransactionController::class, 'create'])->name('transactions.create');
        Route::post('/transactions', [KasirTransactionController::class, 'store'])->name('transactions.store');
        Route::get('/reports', [KasirReportController::class, 'index'])->name('reports.index');
    });