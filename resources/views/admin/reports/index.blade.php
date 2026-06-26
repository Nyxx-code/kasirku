@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-12">

    {{-- KOTAK METRIK RINGKASAN --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm flex flex-col justify-center">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Total Transaksi</span>
            <span class="text-3xl font-black text-slate-800">{{ $totalTransactions ?? 0 }}</span>
        </div>
        
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm flex flex-col justify-center">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Item Terjual</span>
            <span class="text-3xl font-black text-slate-800">{{ $totalItems ?? 0 }} Pcs</span>
        </div>

        <div class="bg-emerald-50 rounded-2xl p-6 border border-emerald-100 shadow-sm flex flex-col justify-center">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 mb-1">Total Omzet Bersih</span>
            <span class="text-3xl font-black text-emerald-700">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</span>
        </div>
    </div>

    @if(session('status'))
        <div class="bg-green-50 border border-green-200 p-4 rounded-xl text-green-700 font-medium shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        
        {{-- HEADER TABEL + FILTER + EXPORT --}}
        <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center bg-slate-50 gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Laporan Penjualan</h2>
                <p class="text-xs text-slate-500 mt-0.5">Daftar transaksi per struk/nota pembayaran.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <form action="{{ route('admin.reports.index') }}" method="GET" class="flex items-center gap-2">
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-3 py-2 rounded-xl border border-slate-200 text-sm outline-none text-slate-600">
                    <span class="text-slate-400 font-medium">-</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-3 py-2 rounded-xl border border-slate-200 text-sm outline-none text-slate-600">
                    <button type="submit" class="px-4 py-2 rounded-xl text-sm font-bold text-white transition hover:opacity-90 shadow-sm" style="background-color: #0f172a;">
                        Filter
                    </button>
                </form>

                <div class="w-px h-8 bg-slate-200 mx-1 hidden md:block"></div>

                <button onclick="alert('Fitur PDF sedang disiapkan!')" class="px-4 py-2 bg-red-50 text-red-600 border border-red-100 font-bold rounded-xl text-sm hover:bg-red-100 transition">
                    Cetak PDF
                </button>
            </div>
        </div>

        {{-- TABEL LAPORAN (SATU BARIS = SATU STRUK TRANSAKSI) --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-xs uppercase font-bold text-slate-600 border-b border-slate-100">
                    <tr>
                        <th class="p-4 w-12 text-center">No</th>
                        <th class="p-4 w-48">Waktu & Transaksi</th>
                        <th class="p-4 w-40">Kasir</th>
                        <th class="p-4">Daftar Barang Dibeli</th>
                        <th class="p-4 text-center">Total Qty</th>
                        <th class="p-4 text-right">Grand Total</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($sales as $sale)
                        <tr class="hover:bg-slate-50/50 transition align-top">
                            
                            {{-- Nomor Urut --}}
                            <td class="p-4 text-center text-slate-500 font-medium mt-1">{{ $loop->iteration }}</td>
                            
                            {{-- Info Transaksi --}}
                            <td class="p-4">
                                <span class="block text-xs font-bold text-slate-400">{{ $sale->created_at->format('d M Y, H:i') }}</span>
                                <span class="font-mono text-sm text-slate-800 font-bold">TRX-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>

                            {{-- Kasir --}}
                            <td class="p-4 text-slate-700 font-medium">
                                {{ optional($sale->user)->name ?? 'Tidak Diketahui' }}
                            </td>
                            
                            {{-- Daftar Barang Digabung dalam 1 Kolom --}}
                            <td class="p-4">
                                <ul class="space-y-1">
                                    @foreach($sale->saleItems as $item)
                                        <li class="flex items-center gap-2 text-slate-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                            <span class="font-semibold">{{ optional($item->product)->name ?? 'Produk Dihapus' }}</span>
                                            <span class="text-xs text-slate-500 font-mono">({{ $item->qty }}x)</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            
                            {{-- Total Qty dalam 1 Struk --}}
                            <td class="p-4 text-center font-bold text-[#1e4e79]">
                                {{ $sale->saleItems->sum('qty') }} Item
                            </td>
                            
                            {{-- Grand Total per Struk --}}
                            <td class="p-4 text-right font-black text-emerald-600 text-base">
                                Rp {{ number_format($sale->total, 0, ',', '.') }}
                            </td>

                            {{-- Tombol Aksi Hapus --}}
                            <td class="p-4 text-center">
                                <form action="{{ route('admin.reports.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi TRX-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }} beserta semua isinya?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-semibold px-3 py-1.5 rounded-lg border border-red-100 hover:bg-red-50 transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-12 text-center text-slate-400">
                            Belum ada riwayat penjualan sama sekali.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection