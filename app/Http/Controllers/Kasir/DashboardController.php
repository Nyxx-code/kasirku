<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();

        $salesCount = 0;
        $revenue = 0;

        if ($userId) {
            $salesCount = Sale::where('user_id', $userId)->count();
            $revenue = (int) Sale::where('user_id', $userId)->sum('total');
        }

        return view('kasir.dashboard', [
            'salesCount' => $salesCount,
            'revenue' => $revenue,
        ]);
    }
}
