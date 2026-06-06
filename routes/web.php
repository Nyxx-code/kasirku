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
        // 1. Halaman Utama Grafik Dashboard
        Route::get('/', [DeveloperController::class, 'index'])->name('dashboard');
        
        // 2. Halaman BARU: Tabel Kelola Manajemen Admin (index.blade.php)
        Route::get('/admin', [DeveloperController::class, 'manageAdmin'])->name('admin.index');
        
        // 3. Halaman Form Registrasi Admin
        Route::get('/register-admin', [DeveloperController::class, 'showRegisterForm'])->name('register.admin');
        Route::post('/register-admin', [DeveloperController::class, 'storeAdmin'])->name('register.admin.submit');
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
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
        Route::put('/products/{productId}', [AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{productId}', [AdminProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
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