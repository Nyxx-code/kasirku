@extends('layouts.app')

@section('title', 'Transaksi Penjualan')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold">Transaksi Penjualan</h1>
            <p class="text-sm text-slate-500">Pilih produk dan masukkan jumlah.</p>
        </div>
    </div>

    {{-- Notifikasi Jika Transaksi Berhasil --}}
    @if(session('status'))
        <div class="mt-4 bg-green-50 border border-green-200 p-4 rounded-xl text-green-700 font-medium shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    {{-- Notifikasi Jika Ada Error (Misal: Uang Kurang) --}}
    @if($errors->any())
        <div class="mt-4 bg-red-50 border border-red-200 p-4 rounded-xl text-red-700 text-sm shadow-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error) 
                    <li>{{ $error }}</li> 
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tambahkan id="transaction-form" agar JavaScript bisa me-resetnya jika diperlukan --}}
    <form id="transaction-form" action="{{ route('kasir.transactions.store') }}" method="post" class="mt-6 grid gap-6">
        @csrf
        <div class="rounded-xl border bg-white shadow-sm overflow-hidden">
            <div class="border-b bg-slate-50 px-6 py-4 text-sm font-semibold text-slate-700">Daftar Produk Toko</div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="border-b text-slate-500">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Produk</th>
                            <th class="px-6 py-3 font-semibold">Harga</th>
                            <th class="px-6 py-3 font-semibold text-center">Stok</th>
                            <th class="px-6 py-3 font-semibold text-center w-32">Qty</th>
                            <th class="px-6 py-3 font-semibold text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($products as $product)
                            <tr class="hover:bg-slate-50/50 transition" data-price="{{ $product->price }}">
                                <td class="px-6 py-3 font-medium text-slate-800">{{ $product->name }}</td>
                                <td class="px-6 py-3 text-slate-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-3 text-center">
                                    <span class="{{ $product->stock <= 5 ? 'text-red-600 font-bold' : 'text-slate-600' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-center">
                                    {{-- 
                                        PERBAIKAN LOGIKA QTY:
                                        Jika ada 'status' sukses, paksa Qty jadi 0.
                                        Hanya gunakan old() jika ada error (agar kasir tidak perlu ngetik ulang).
                                    --}}
                                    @php
                                        $inputValue = session('status') ? 0 : old('items.'.$product->id, 0);
                                    @endphp
                                    <input 
                                        name="items[{{ $product->id }}]" 
                                        type="number" 
                                        min="0" 
                                        max="{{ $product->stock }}"
                                        value="{{ $inputValue }}" 
                                        class="w-20 rounded-lg border border-slate-200 px-3 py-1.5 text-center outline-none focus:border-blue-500" 
                                        data-qty 
                                    />
                                </td>
                                <td class="px-6 py-3 font-semibold text-right text-slate-700" data-subtotal>Rp 0</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid gap-6 rounded-xl border bg-white p-6 shadow-sm md:grid-cols-2 lg:grid-cols-4 items-end">
            <div class="grid gap-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Grand Total</span>
                <span class="text-2xl font-black text-slate-800" id="grand-total">Rp 0</span>
            </div>
            
            <div class="grid gap-2">
                <label for="paid-input" class="text-xs font-bold uppercase tracking-wider text-slate-500">Nominal Uang (Rp)</label>
                {{-- Jika sukses, paksa form bayar kosong. Jika error, kembalikan uang yang diketik --}}
                <input 
                    name="paid" 
                    type="number" 
                    min="0" 
                    value="{{ session('status') ? '' : old('paid') }}" 
                    class="rounded-lg border border-slate-200 px-4 py-2 outline-none focus:border-blue-500 w-full" 
                    id="paid-input" 
                    placeholder="Contoh: 50000"
                    required 
                />
            </div>
            
            <div class="grid gap-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Uang Kembalian</span>
                <span class="text-xl font-bold text-emerald-600" id="change-amount">Rp 0</span>
            </div>
            
            <div class="flex">
                <button type="submit" class="w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-slate-800 shadow-md">
                    Simpan Transaksi
                </button>
            </div>
        </div>
    </form>

    <script>
        const rows = document.querySelectorAll('tr[data-price]');
        const paidInput = document.getElementById('paid-input');
        const grandTotalEl = document.getElementById('grand-total');
        const changeEl = document.getElementById('change-amount');

        const formatRupiah = (value) => new Intl.NumberFormat('id-ID').format(value || 0);

        const updateTotals = () => {
            let total = 0;

            rows.forEach((row) => {
                const price = Number(row.dataset.price || 0);
                const qtyInput = row.querySelector('[data-qty]');
                const subtotalEl = row.querySelector('[data-subtotal]');
                const qty = Number(qtyInput?.value || 0);
                const subtotal = price * qty;

                if (subtotalEl) {
                    subtotalEl.textContent = `Rp ${formatRupiah(subtotal)}`;
                }

                total += subtotal;
            });

            const paid = Number(paidInput?.value || 0);
            const change = Math.max(paid - total, 0);

            grandTotalEl.textContent = `Rp ${formatRupiah(total)}`;
            
            // Beri warna merah muda jika uang belum cukup, hijau jika cukup
            if (paid > 0 && paid < total) {
                changeEl.textContent = "Uang Kurang!";
                changeEl.classList.replace('text-emerald-600', 'text-red-500');
            } else {
                changeEl.textContent = `Rp ${formatRupiah(change)}`;
                changeEl.classList.replace('text-red-500', 'text-emerald-600');
            }
        };

        rows.forEach((row) => {
            const qtyInput = row.querySelector('[data-qty]');
            qtyInput?.addEventListener('input', updateTotals);
        });

        paidInput?.addEventListener('input', updateTotals);
        
        // Panggil saat halaman pertama dimuat
        updateTotals();
    </script>
@endsection