<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // 1. FILTER MUTLAK (JURUS NUKLIR): Ambil ID Kasir terpisah lalu gabungkan manual
        // Ini menghindari error logika dari orWhere() yang membuat data bocor
        $kasirIds = User::where('store_id', $user->id)->pluck('id')->toArray();
        $validUserIds = array_merge([$user->id], $kasirIds);

        // 2. Tarik data transaksi HANYA dari daftar ID yang sah di atas
        $query = Sale::whereIn('user_id', $validUserIds)->with(['user', 'saleItems.product']);

        // 3. Logika Filter Rentang Tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00', 
                $request->end_date . ' 23:59:59'
            ]);
        }

        $sales = $query->latest()->get();

        // 4. Kalkulasi metrik ringkasan otomatis
        $totalTransactions = $sales->count();
        $totalRevenue = $sales->sum('total'); 
        
        $totalItems = 0;
        foreach ($sales as $sale) {
            $totalItems += $sale->saleItems->sum('qty');
        }

        return view('admin.reports.index', compact(
            'sales', 
            'totalRevenue', 
            'totalTransactions', 
            'totalItems'
        ));
    }

    public function destroy($id)
    {
        $user = auth()->user();

        // KUNCI PENGAMAN EKSTRA (JURUS NUKLIR)
        $kasirIds = User::where('store_id', $user->id)->pluck('id')->toArray();
        $validUserIds = array_merge([$user->id], $kasirIds);

        // Pastikan Admin hanya bisa menemukan dan menghapus riwayat transaksinya sendiri
        $sale = Sale::whereIn('user_id', $validUserIds)->findOrFail($id);

        // Kembalikan stok produk sebelum riwayat dihapus
        foreach ($sale->saleItems as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->qty);
            }
        }

        // Hapus detail item dan data transaksinya
        $sale->saleItems()->delete();
        $sale->delete();

        return redirect()->route('admin.reports.index')->with('status', 'Riwayat transaksi berhasil dihapus dan stok dikembalikan ke katalog.');
    }
}