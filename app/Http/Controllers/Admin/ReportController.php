<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $start = $request->query('start');
        $end = $request->query('end');

        $query = Sale::with('user')->orderByDesc('sold_at');

        if ($start) {
            $query->whereDate('sold_at', '>=', Carbon::parse($start));
        }

        if ($end) {
            $query->whereDate('sold_at', '<=', Carbon::parse($end));
        }

        $sales = $query->get();

        return view('admin.reports.index', [
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
