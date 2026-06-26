<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $salesCount = 0;
        $revenue = 0;

        if ($user) {
            $salesCount = Sale::where('user_id', $user->id)->count();
            $revenue = (int) Sale::where('user_id', $user->id)->sum('total');
        }

        // Mengambil kasir di toko yang sama, maksimal 2
        $kasirs = User::where('store_id', $user->store_id)
                      ->where('role', 'kasir')
                      ->where('id', '!=', $user->id)
                      ->limit(2)
                      ->get();

        return view('kasir.dashboard', [
            'salesCount' => $salesCount,
            'revenue' => $revenue,
            'kasirs' => $kasirs,
        ]);
    }
}