<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        // Ambil ID kasir yang sedang aktif / login
        $kasirId = Auth::id();

        // Jumlahkan total omzet khusus dari transaksi kasir ini saja
        $totalRevenue = Sale::where('user_id', $kasirId)->sum('total');

        // Tarik data transaksi beserta detail barang, khusus milik kasir ini
        $sales = Sale::with('saleItems.product')
                     ->where('user_id', $kasirId)
                     ->latest()
                     ->get();

        return view('kasir.reports.index', compact('sales', 'totalRevenue'));
    }
}