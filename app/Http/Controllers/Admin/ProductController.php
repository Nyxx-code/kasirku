<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('store_id', Auth::id())->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // LOGIKA PENGECEKAN SKU MANUAL (KEBAL ERROR)
        // Jika kolom SKU diisi sesuatu (tidak kosong), baru kita cek
        if (!empty($request->sku)) {
            $skuKembar = Product::where('store_id', Auth::id())
                                ->where('sku', $request->sku)
                                ->exists();
                                
            if ($skuKembar) {
                // Beri pesan error yang lebih jelas agar ketahuan SKU apa yang kembar
                return back()
                    ->withErrors(['sku' => 'Gagal: Kode SKU "' . $request->sku . '" sudah dipakai oleh produk lain di tokomu!'])
                    ->withInput();
            }
        }

        $data = $request->all();
        $data['store_id'] = Auth::id();

        Product::create($data);

        return redirect()->route('admin.products.index')->with('status', 'Produk baru berhasil ditambahkan!');
    }

    public function update(Request $request, $productId)
    {
        $product = Product::where('store_id', Auth::id())->findOrFail($productId);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // LOGIKA PENGECEKAN SKU MANUAL SAAT EDIT
        if (!empty($request->sku)) {
            $skuKembar = Product::where('store_id', Auth::id())
                                ->where('sku', $request->sku)
                                ->where('id', '!=', $productId) // Abaikan produk yang sedang diedit ini
                                ->exists();
                                
            if ($skuKembar) {
                return back()
                    ->withErrors(['sku' => 'Gagal: Kode SKU "' . $request->sku . '" sudah dipakai oleh produk lain di tokomu!'])
                    ->withInput();
            }
        }

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('status', 'Data produk berhasil diperbarui!');
    }

    public function destroy($productId)
    {
        $product = Product::where('store_id', Auth::id())->findOrFail($productId);

        if ($product->saleItems()->exists()) {
            return redirect()->route('admin.products.index')
                ->withErrors(['Gagal: Produk tidak bisa dihapus karena sudah tercatat dalam riwayat laporan penjualan.']);
        }

        $product->delete();
        
        return redirect()->route('admin.products.index')->with('status', 'Produk berhasil dihapus secara permanen!');
    }
}