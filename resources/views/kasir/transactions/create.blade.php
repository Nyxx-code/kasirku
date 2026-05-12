@extends('layouts.app')

@section('title', 'Transaksi Penjualan')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold">Transaksi Penjualan</h1>
            <p class="text-sm text-slate-500">Pilih produk dan masukkan jumlah.</p>
        </div>
    </div>

    <form action="{{ route('kasir.transactions.store') }}" method="post" class="mt-6 grid gap-6">
        @csrf
        <div class="rounded-xl border bg-white">
            <div class="border-b px-6 py-4 text-sm font-semibold">Daftar Produk</div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-left text-slate-500">
                        <tr>
                            <th class="px-6 py-3">Produk</th>
                            <th class="px-6 py-3">Harga</th>
                            <th class="px-6 py-3">Stok</th>
                            <th class="px-6 py-3">Qty</th>
                            <th class="px-6 py-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="border-t" data-price="{{ $product->price }}">
                                <td class="px-6 py-3">{{ $product->name }}</td>
                                <td class="px-6 py-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-3">{{ $product->stock }}</td>
                                <td class="px-6 py-3">
                                    <input name="items[{{ $product->id }}]" type="number" min="0" value="{{ old('items.'.$product->id, 0) }}" class="w-24 rounded border px-2 py-1" data-qty />
                                </td>
                                <td class="px-6 py-3 font-semibold" data-subtotal>Rp 0</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid gap-4 rounded-xl border bg-white p-6 sm:grid-cols-2">
            <div class="grid gap-2 text-sm">
                <span class="text-slate-500">Grand Total</span>
                <span class="text-2xl font-semibold" id="grand-total">Rp 0</span>
            </div>
            <label class="grid gap-2 text-sm">
                Nominal Bayar
                <input name="paid" type="number" min="0" value="{{ old('paid', 0) }}" class="rounded-lg border px-3 py-2" id="paid-input" required />
            </label>
            <div class="grid gap-2 text-sm">
                <span class="text-slate-500">Kembalian</span>
                <span class="text-xl font-semibold" id="change-amount">Rp 0</span>
            </div>
            <div class="flex items-end sm:col-span-2">
                <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Simpan Transaksi</button>
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
            changeEl.textContent = `Rp ${formatRupiah(change)}`;
        };

        rows.forEach((row) => {
            const qtyInput = row.querySelector('[data-qty]');
            qtyInput?.addEventListener('input', updateTotals);
        });

        paidInput?.addEventListener('input', updateTotals);
        updateTotals();
    </script>
@endsection
