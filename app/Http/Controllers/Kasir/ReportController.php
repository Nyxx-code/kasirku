<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID kasir yang sedang aktif / login
        $kasirId = Auth::id();

        // Siapkan pondasi query khusus untuk kasir ini saja
        $query = Sale::where('user_id', $kasirId);

        // FITUR FILTER 1: Berdasarkan Dropdown Hari (7, 14, 21, 30)
        if ($request->has('filter_hari') && $request->filter_hari != '') {
            $hari = (int) $request->filter_hari;
            $query->where('created_at', '>=', now()->subDays($hari));
        }

        // FITUR FILTER 2: Berdasarkan Rentang Tanggal Manual
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // Hitung total omzet sesuai dengan data yang sudah difilter
        // Menggunakan (clone) agar pondasi query aslinya tidak rusak saat mengambil $sales
        $totalRevenue = (clone $query)->sum('total');

        // Tarik data transaksi beserta detail barang, khusus milik kasir ini
        $sales = $query->with('saleItems.product')->latest()->get();

        return view('kasir.reports.index', compact('sales', 'totalRevenue'));
    }

    // FUNGSI BARU: Untuk Mencetak Struk Thermal Kasir
    public function print($id)
    {
        // Tarik data transaksi spesifik beserta rincian barang dan nama kasirnya
        $sale = Sale::with(['saleItems.product', 'user'])->findOrFail($id);
        
        // Lempar ke tampilan khusus struk
        return view('kasir.reports.print', compact('sale'));
    }
}