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

   public function importExcel(\Illuminate\Http\Request $request)
{
    try {
        $rows = $request->input('data'); 

        if (!$rows || count($rows) == 0) {
            return response()->json(['success' => false, 'message' => 'File Excel kosong.']);
        }

        $inserted = 0;
        
        foreach ($rows as $index => $baris) {
            // FITUR SAKTI: Otomatis lewati baris pertama (Judul/Header Excel)
            if ($index === 0) continue;

            // Fitur Ekstra: Lewati juga kalau isinya kebetulan tulisan "nama produk" atau "nama barang"
            $cekNama = strtolower(trim(isset($baris[1]) ? $baris[1] : ''));
            if ($cekNama === 'nama produk' || $cekNama === 'nama barang' || $cekNama === '') continue;

            \App\Models\Product::create([
                'sku'      => $baris[0] ?? 'SKU-' . rand(1000, 9999), // Kolom A 
                'name'     => $baris[1],                              // Kolom B 
                'price'    => isset($baris[2]) ? (int)$baris[2] : 0,  // Kolom C 
                'stock'    => isset($baris[3]) ? (int)$baris[3] : 0,  // Kolom D 
                'store_id' => \Illuminate\Support\Facades\Auth::id() ?? 1,
            ]);
            $inserted++;
        }

        if ($inserted === 0) {
            return response()->json(['success' => false, 'message' => 'Data kosong atau hanya berisi judul kolom.']);
        }

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}
}