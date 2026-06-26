<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function create(): View
    {
        $user = Auth::user();
        
        // Identifikasi ID Toko: Jika Kasir ambil store_id-nya, jika Admin ambil id-nya sendiri
        $storeId = $user->store_id ?: $user->id;

        return view('kasir.transactions.create', [
            // KUNCI 1: Hanya panggil produk yang 'store_id'-nya cocok dengan toko ini
            'products' => Product::where('store_id', $storeId)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'items' => ['required', 'array'],
            'items.*' => ['nullable', 'integer', 'min:0'],
            'paid' => ['required', 'integer', 'min:0'],
        ]);

        $items = collect($data['items'])
            ->map(fn ($qty, $productId) => [
                'product_id' => (int) $productId,
                'qty' => (int) $qty,
            ])
            ->filter(fn ($item) => $item['qty'] > 0)
            ->values();

        if ($items->isEmpty()) {
            return redirect()
                ->back()
                ->withErrors(['items' => 'Pilih minimal satu produk.'])
                ->withInput();
        }

        $user = Auth::user();
        $storeId = $user->store_id ?: $user->id;

        // KUNCI 2: Keamanan Ekstra! Pastikan produk yang dikirim dari form benar-benar milik toko ini
        $products = Product::where('store_id', $storeId)
            ->whereIn('id', $items->pluck('product_id'))
            ->get()
            ->keyBy('id');

        $total = 0;

        foreach ($items as $item) {
            $product = $products->get($item['product_id']);

            // Jika produk tidak ditemukan (atau beda toko), tolak transaksinya
            if (! $product) {
                return redirect()
                    ->back()
                    ->withErrors(['items' => 'Produk tidak ditemukan atau bukan milik toko ini.'])
                    ->withInput();
            }

            if ($product->stock < $item['qty']) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'items' => 'Stok produk '.$product->name.' tidak mencukupi.',
                    ])
                    ->withInput();
            }

            $total += $product->price * $item['qty'];
        }

        if ($data['paid'] < $total) {
            return redirect()
                ->back()
                ->withErrors(['paid' => 'Pembayaran kurang dari total.'])
                ->withInput();
        }

        $userId = $user->id;

        DB::transaction(function () use ($items, $products, $total, $data, $userId): void {
            $sale = Sale::create([
                'user_id' => $userId,
                'total' => $total,
                'paid' => $data['paid'],
                'change' => $data['paid'] - $total,
                'sold_at' => now(),
            ]);

            foreach ($items as $item) {
                $product = $products->get($item['product_id']);
                $subtotal = $product->price * $item['qty'];

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'qty' => $item['qty'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock', $item['qty']);
            }
        });

        // KUNCI 3: Gunakan session flash agar keranjang otomatis kosong seperti yang kita atur di file view
        return redirect()
            ->route('kasir.transactions.create')
            ->with('status', 'Transaksi berhasil disimpan.');
    }
}