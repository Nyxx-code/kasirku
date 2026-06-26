<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. GEMBOK MUTLAK: Hanya tarik ID Admin ini dan ID Kasirnya
        $validUserIds = User::where('store_id', $user->id)
                            ->orWhere('id', $user->id)
                            ->pluck('id')
                            ->toArray();

        // 2. Terapkan gembok ke tabel Sales agar tidak bocor
        $sales = Sale::whereIn('user_id', $validUserIds)
                     ->with(['user', 'saleItems.product'])
                     ->latest()
                     ->get();

        // 3. Kalkulasi pendapatan untuk tampilan
        $totalRevenue = 0;
        foreach ($sales as $sale) {
            foreach ($sale->saleItems as $item) {
                $totalRevenue += ($item->price ?? optional($item->product)->price ?? 0) * $item->qty;
            }
        }

        // 4. Lempar data ke view transaksi.index milikmu
        return view('transaksi.index', compact('sales', 'totalRevenue'));
    }
}