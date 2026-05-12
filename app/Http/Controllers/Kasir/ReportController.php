<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $start = $request->query('start');
        $end = $request->query('end');
        $userId = Auth::id();

        $query = Sale::with('user')
            ->where('user_id', $userId)
            ->orderByDesc('sold_at');

        if ($start) {
            $query->whereDate('sold_at', '>=', Carbon::parse($start));
        }

        if ($end) {
            $query->whereDate('sold_at', '<=', Carbon::parse($end));
        }

        $sales = $query->get();

        return view('kasir.reports.index', [
            'sales' => $sales,
            'totalRevenue' => (int) $sales->sum('total'),
            'totalTransactions' => $sales->count(),
            'filters' => [
                'start' => $start,
                'end' => $end,
            ],
        ]);
    }
}
