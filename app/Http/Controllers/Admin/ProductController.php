<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $editId = $request->query('edit');
        $editProduct = $editId ? Product::find($editId) : null;

        return view('admin.products.index', [
            'products' => Product::orderBy('name')->get(),
            'editProduct' => $editProduct,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:50', 'unique:products,sku'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, int $productId): RedirectResponse
    {
        $product = Product::findOrFail($productId);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('products', 'sku')->ignore($product->id),
            ],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy(int $productId): RedirectResponse
    {
        try {

            $product = Product::findOrFail($productId);
            $product->delete();

            return redirect()
                ->route('admin.products.index')
                ->with('status', 'Produk berhasil dihapus.');

        } catch (QueryException $e) {

            return redirect()
                ->route('admin.products.index')
                ->with('error', 'Produk tidak bisa dihapus karena sudah memiliki transaksi.');
        }
    }
}