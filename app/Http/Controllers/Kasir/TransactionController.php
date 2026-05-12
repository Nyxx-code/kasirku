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
        return view('kasir.transactions.create', [
            'products' => Product::orderBy('name')->get(),
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

        $products = Product::whereIn('id', $items->pluck('product_id'))
            ->get()
            ->keyBy('id');

        $total = 0;

        foreach ($items as $item) {
            $product = $products->get($item['product_id']);

            if (! $product) {
                return redirect()
                    ->back()
                    ->withErrors(['items' => 'Produk tidak ditemukan.'])
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

        $userId = Auth::id();

        if (! $userId) {
            abort(401);
        }

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

        return redirect()
            ->route('kasir.transactions.create')
            ->with('status', 'Transaksi berhasil disimpan.');
    }
}
