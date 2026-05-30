<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan halaman transaksi
        return view('transaksi.index'); // Sesuaikan dengan lokasi view Anda
    }
}