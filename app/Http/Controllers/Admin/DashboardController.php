<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. GEMBOK NUKLIR UNTUK DASHBOARD
        $kasirIds = \App\Models\User::where('store_id', $user->id)->pluck('id')->toArray();
        $validUserIds = array_merge([$user->id], $kasirIds);

        // 2. Tarik data penjualan KHUSUS toko ini
        $sales = \App\Models\Sale::whereIn('user_id', $validUserIds)
                                 ->with(['user', 'saleItems.product'])
                                 ->latest()
                                 ->get();

        // 3. Tarik data kasir (karena tadi kamu gabung tabelnya di dashboard)
        $cashiers = \App\Models\User::where('store_id', $user->id)
                                    ->where('role', 'kasir')
                                    ->get();

        // 4. Hitung total pendapatan
        $totalRevenue = 0;
        foreach ($sales as $sale) {
            foreach ($sale->saleItems as $item) {
                $totalRevenue += ($item->price ?? optional($item->product)->price ?? 0) * $item->qty;
            }
        }

        return view('admin.dashboard', compact('sales', 'cashiers', 'totalRevenue'));
    }

    public function destroyCashier($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('status', 'Akun Kasir Berhasil Dihapus!');
    }
}