@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        @if(session('status'))
    <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-sm text-green-700">
        {{ session('status') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-sm text-red-700">
        {{ session('error') }}
    </div>
@endif
        <div>
            <h1 class="text-xl font-semibold">Kelola Produk</h1>
            <p class="text-sm text-slate-500">Tambah, ubah, dan hapus produk.</p>
        </div>
    </div>

    <div class="mt-6 rounded-xl border bg-white p-6">
        <h2 class="text-base font-semibold">
            {{ $editProduct ? 'Edit Produk' : 'Tambah Produk' }}
        </h2>
        <form
            action="{{ $editProduct ? route('admin.products.update', $editProduct->id) : route('admin.products.store') }}"
            method="post"
            class="mt-4 grid gap-4 sm:grid-cols-2"
        >
            @csrf
            @if ($editProduct)
                @method('PUT')
            @endif
            <label class="grid gap-2 text-sm">
                Nama
                <input name="name" value="{{ old('name', $editProduct?->name) }}" class="rounded-lg border px-3 py-2" required />
            </label>
            <label class="grid gap-2 text-sm">
                SKU
                <input name="sku" value="{{ old('sku', $editProduct?->sku) }}" class="rounded-lg border px-3 py-2" />
            </label>
            <label class="grid gap-2 text-sm">
                Harga
                <input name="price" type="number" min="0" value="{{ old('price', $editProduct?->price) }}" class="rounded-lg border px-3 py-2" required />
            </label>
            <label class="grid gap-2 text-sm">
                Stok
                <input name="stock" type="number" min="0" value="{{ old('stock', $editProduct?->stock) }}" class="rounded-lg border px-3 py-2" required />
            </label>
            <div class="sm:col-span-2">
                <div class="flex flex-wrap gap-3">
                    <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">
                        {{ $editProduct ? 'Simpan Perubahan' : 'Simpan' }}
                    </button>
                    @if ($editProduct)
                        <a href="{{ route('admin.products.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600">
                            Batal
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <div class="mt-8 rounded-xl border bg-white">
        <div class="border-b px-6 py-4 text-sm font-semibold">Daftar Produk</div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-left text-slate-500">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">SKU</th>
                        <th class="px-6 py-3">Harga</th>
                        <th class="px-6 py-3">Stok</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-t align-top">
                            <td class="px-6 py-3">{{ $product->name }}</td>
                            <td class="px-6 py-3">{{ $product->sku ?? '-' }}</td>
                            <td class="px-6 py-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-3">{{ $product->stock }}</td>
                            <td class="px-6 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('admin.products.index', ['edit' => $product->id]) }}" class="rounded bg-amber-500 px-3 py-1 text-xs font-semibold text-white">
                                        Edit
                                    </a>
                                </div>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded bg-rose-500 px-3 py-1 text-xs font-semibold text-white" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
