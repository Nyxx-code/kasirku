@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-12 mt-8">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        
        <div class="flex justify-between items-center border-b border-slate-100 pb-5 mb-5">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Riwayat Penjualan Saya</h1>
                <p class="text-sm text-slate-500 mt-1">Laporan semua transaksi yang telah Anda layani.</p>
            </div>
            <div class="text-right bg-blue-50 px-6 py-3 rounded-xl border border-blue-100 shadow-sm">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 block">Total Pendapatan Saya</span>
                <span class="text-xl font-black text-[#1e4e79]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- BARIS FILTER --}}
        <div class="flex justify-end mb-5">
            <form action="" method="GET" class="flex items-center gap-2 flex-wrap md:flex-nowrap">
                <select name="filter_hari" onchange="this.form.submit()" class="px-3 py-2 rounded-xl border border-slate-200 text-sm outline-none text-slate-600 bg-white cursor-pointer hover:border-slate-300 transition">
                    <option value="">Semua Waktu</option>
                    <option value="7" {{ request('filter_hari') == '7' ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="14" {{ request('filter_hari') == '14' ? 'selected' : '' }}>14 Hari Terakhir</option>
                    <option value="21" {{ request('filter_hari') == '21' ? 'selected' : '' }}>21 Hari Terakhir</option>
                    <option value="30" {{ request('filter_hari') == '30' ? 'selected' : '' }}>30 Hari Terakhir</option>
                </select>

                <div class="w-px h-6 bg-slate-300 mx-1 hidden md:block"></div>

                <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-3 py-2 rounded-xl border border-slate-200 text-sm outline-none text-slate-600">
                <span class="text-slate-400 font-medium">-</span>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-3 py-2 rounded-xl border border-slate-200 text-sm outline-none text-slate-600">
                <button type="submit" class="px-4 py-2 rounded-xl text-sm font-bold text-white transition hover:opacity-90 shadow-sm" style="background-color: #0f172a;">
                    Filter
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-xs uppercase font-bold text-slate-600 border-b border-slate-100">
                    <tr>
                        <th class="p-4 w-12 text-center">No</th>
                        <th class="p-4">Waktu & Transaksi</th>
                        <th class="p-4">SKU & Nama Barang</th>
                        <th class="p-4">Harga Satuan</th>
                        <th class="p-4 text-center">Qty</th>
                        <th class="p-4 text-right">Subtotal</th>
                        <th class="p-4 text-center">Aksi</th> {{-- TAMBAHAN KOLOM AKSI --}}
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @php $no = 1; @endphp
                    @forelse($sales as $sale)
                        @php 
                            // Hitung jumlah barang di dalam 1 transaksi
                            $jumlahItem = $sale->saleItems->count() ?: 1; 
                        @endphp
                        
                        @forelse($sale->saleItems as $index => $item)
                        <tr class="hover:bg-slate-50/50 transition {{ $loop->last ? 'border-b-2 border-slate-100' : 'border-b border-slate-50' }}">
                            
                            @if($loop->first)
                            <td class="p-4 text-center text-slate-500 align-top border-r border-slate-50" rowspan="{{ $jumlahItem }}">
                                {{ $no++ }}
                            </td>
                            <td class="p-4 align-top border-r border-slate-50" rowspan="{{ $jumlahItem }}">
                                <span class="block text-xs font-bold text-slate-400">{{ $sale->created_at->format('d M Y, H:i') }}</span>
                                <span class="font-mono text-sm text-slate-700">TRX-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            @endif
                            
                            <td class="p-4">
                                <span class="block text-xs font-mono text-slate-500">{{ optional($item->product)->sku ?? '-' }}</span>
                                <span class="font-bold text-slate-800">{{ optional($item->product)->name ?? 'Produk Dihapus' }}</span>
                            </td>
                            
                            <td class="p-4 text-slate-700 font-medium">
                                Rp {{ number_format($item->price ?? optional($item->product)->price ?? 0, 0, ',', '.') }}
                            </td>
                            
                            <td class="p-4 text-center font-bold text-[#1e4e79]">
                                {{ $item->qty }}
                            </td>
                            
                            <td class="p-4 text-right font-bold text-slate-900">
                                Rp {{ number_format(($item->price ?? optional($item->product)->price ?? 0) * $item->qty, 0, ',', '.') }}
                            </td>

                            {{-- TAMBAHAN TOMBOL CETAK --}}
                            @if($loop->first)
                            <td class="p-4 text-center align-top border-l border-slate-50" rowspan="{{ $jumlahItem }}">
                                <a href="{{ route('kasir.reports.print', $sale->id) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs font-bold px-4 py-2 rounded-lg border border-blue-200 bg-blue-50 hover:bg-blue-100 transition inline-block">
                                    🖨️ Cetak
                                </a>
                            </td>
                            @endif

                        </tr>
                        @empty
                        <tr class="bg-red-50/30 border-b-2 border-slate-100">
                            <td class="p-4 text-center text-slate-500">{{ $no++ }}</td>
                            <td class="p-4"><span class="font-mono text-sm">TRX-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</span></td>
                            <td colspan="4" class="p-4 text-red-500 italic text-sm">Detail transaksi ini tidak ditemukan.</td>
                            <td class="p-4 text-center border-l border-slate-50">
                                <a href="{{ route('kasir.reports.print', $sale->id) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs font-bold px-4 py-2 rounded-lg border border-blue-200 bg-blue-50 hover:bg-blue-100 transition inline-block">
                                    🖨️ Cetak
                                </a>
                            </td>
                        </tr>
                        @endforelse
                        
                    @empty
                    <tr>
                        <td colspan="7" class="p-12 text-center text-slate-400">
                            Anda belum memiliki riwayat transaksi penjualan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection