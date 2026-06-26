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
                        </tr>
                        @empty
                        <tr class="bg-red-50/30 border-b-2 border-slate-100">
                            <td class="p-4 text-center text-slate-500">{{ $no++ }}</td>
                            <td class="p-4"><span class="font-mono text-sm">TRX-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</span></td>
                            <td colspan="4" class="p-4 text-red-500 italic text-sm">Detail transaksi ini tidak ditemukan.</td>
                        </tr>
                        @endforelse
                        
                    @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center text-slate-400">
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