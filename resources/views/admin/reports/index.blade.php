@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold">Laporan Penjualan</h1>
            <p class="text-sm text-slate-500">Rekap transaksi berdasarkan periode.</p>
        </div>
    </div>

    <form method="get" class="mt-6 grid gap-4 rounded-xl border bg-white p-6 sm:grid-cols-3">
        <label class="grid gap-2 text-sm">
            Dari Tanggal
            <input type="date" name="start" value="{{ $filters['start'] }}" class="rounded-lg border px-3 py-2" />
        </label>
        <label class="grid gap-2 text-sm">
            Sampai Tanggal
            <input type="date" name="end" value="{{ $filters['end'] }}" class="rounded-lg border px-3 py-2" />
        </label>
        <div class="flex items-end">
            <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Terapkan</button>
        </div>
    </form>

    <div class="mt-6 grid gap-6 sm:grid-cols-2">
        <div class="rounded-xl border bg-white p-6">
            <div class="text-sm text-slate-500">Total Transaksi</div>
            <div class="mt-2 text-2xl font-semibold">{{ $totalTransactions }}</div>
        </div>
        <div class="rounded-xl border bg-white p-6">
            <div class="text-sm text-slate-500">Total Pendapatan</div>
            <div class="mt-2 text-2xl font-semibold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="mt-8 rounded-xl border bg-white">
        <div class="border-b px-6 py-4 text-sm font-semibold">Daftar Transaksi</div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-left text-slate-500">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Kasir</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Bayar</th>
                        <th class="px-6 py-3">Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr class="border-t">
                            <td class="px-6 py-3">{{ $sale->sold_at?->format('d M Y H:i') }}</td>
                            <td class="px-6 py-3">{{ $sale->user?->name ?? '-' }}</td>
                            <td class="px-6 py-3">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-3">Rp {{ number_format($sale->paid, 0, ',', '.') }}</td>
                            <td class="px-6 py-3">Rp {{ number_format($sale->change, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr class="border-t">
                            <td colspan="5" class="px-6 py-6 text-center text-slate-500">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
