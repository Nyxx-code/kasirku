@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="grid gap-6 sm:grid-cols-3">
        <div class="rounded-xl border bg-white p-6">
            <div class="text-sm text-slate-500">Total Produk</div>
            <div class="mt-2 text-2xl font-semibold">{{ $productCount }}</div>
        </div>
        <div class="rounded-xl border bg-white p-6">
            <div class="text-sm text-slate-500">Total Transaksi</div>
            <div class="mt-2 text-2xl font-semibold">{{ $salesCount }}</div>
        </div>
        <div class="rounded-xl border bg-white p-6">
            <div class="text-sm text-slate-500">Total Pendapatan</div>
            <div class="mt-2 text-2xl font-semibold">Rp {{ number_format($revenue, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="mt-8 flex flex-wrap gap-3">
        <a href="{{ route('admin.products.index') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Kelola Produk</a>
        <a href="{{ route('admin.reports.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700">Laporan Penjualan</a>
    </div>
@endsection
