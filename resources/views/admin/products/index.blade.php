@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 pb-12">

    @if(session('status'))
        <div class="bg-green-50 border border-green-200 p-4 rounded-xl text-green-700 font-medium shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 p-4 rounded-xl text-red-700 text-sm shadow-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Header --}}
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Katalog & Stok Produk</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola daftar produk dan stok barang toko.</p>
            </div>
            <button onclick="openAddModal()" class="px-5 py-3 rounded-xl text-sm font-bold text-white shadow-sm hover:opacity-90 transition" style="background-color: #0f172a;">
                + Tambah Produk Baru
            </button>
        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr class="text-xs uppercase font-bold text-slate-500 tracking-wider">
                        <th class="p-4 w-16 text-center">No</th>
                        <th class="p-4">SKU</th>
                        <th class="p-4 w-1/3">Nama Produk</th>
                        <th class="p-4">Harga Satuan</th>
                        <th class="p-4 text-center">Sisa Stok</th>
                        <th class="p-4 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($products as $product)
                    @php $stock = intval($product->stock); @endphp
                    
                    {{-- KONDISI WARNA BARIS: Merah muda jika stok < 5 --}}
                    <tr class="{{ $stock < 5 ? 'bg-red-50 hover:bg-red-100' : 'hover:bg-slate-50/50' }} transition">
                        
                        <td class="p-4 text-center {{ $stock < 5 ? 'text-red-600' : 'text-slate-500' }}">{{ $loop->iteration }}</td>
                        <td class="p-4 font-mono text-xs {{ $stock < 5 ? 'text-red-500' : 'text-slate-500' }}">{{ $product->sku ?? '-' }}</td>
                        <td class="p-4 font-bold {{ $stock < 5 ? 'text-red-900' : 'text-slate-800' }}">{{ $product->name }}</td>
                        <td class="p-4 font-medium {{ $stock < 5 ? 'text-red-800' : 'text-slate-700' }}">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        
                        <td class="p-4 text-center">
                            @if($stock >= 5)
                                <span class="bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-md text-xs font-medium border border-emerald-100">
                                    {{ $stock }} Item
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-md text-xs font-bold border border-red-200 animate-pulse">
                                    Sisa {{ $stock }}
                                </span>
                            @endif
                        </td>
                        
                        <td class="p-4 text-center flex justify-center gap-3">
                            <button onclick="openEditModal({{ $product->id }}, '{{ addslashes($product->sku ?? '') }}', '{{ addslashes($product->name) }}', {{ $product->price }}, {{ $stock }})" 
                                class="text-amber-600 hover:text-amber-800 font-semibold text-xs transition">Edit</button>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-semibold transition">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="p-8 text-center text-slate-400">Belum ada produk terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="addModal" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm flex justify-center items-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h2 class="text-lg font-bold text-slate-800">Tambah Barang Baru</h2>
            <button onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form action="{{ route('admin.products.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Kode SKU</label><input type="text" name="sku" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none"></div>
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Nama Barang</label><input type="text" name="name" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none" required></div>
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Harga Jual (Rp)</label><input type="number" name="price" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none" required min="0"></div>
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Stok Awal</label><input type="number" name="stock" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none" required min="0"></div>
            <button type="submit" class="w-full py-3 rounded-xl text-white font-semibold text-sm mt-4" style="background-color: #0f172a;">Simpan</button>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm flex justify-center items-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h2 class="text-lg font-bold text-slate-800">Edit Data Produk</h2>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form id="editForm" method="POST" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Kode SKU</label><input type="text" id="edit_sku" name="sku" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none"></div>
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Nama Barang</label><input type="text" id="edit_name" name="name" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none" required></div>
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Harga Jual (Rp)</label><input type="number" id="edit_price" name="price" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none" required min="0"></div>
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Jumlah Stok</label><input type="number" id="edit_stock" name="stock" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none" required min="0"></div>
            <button type="submit" class="w-full py-3 rounded-xl text-white font-semibold text-sm mt-4 bg-blue-600">Update Data</button>
        </form>
    </div>
</div>

<script>
    function openAddModal() { document.getElementById('addModal').classList.remove('hidden'); }
    function closeAddModal() { document.getElementById('addModal').classList.add('hidden'); }
    function openEditModal(id, sku, name, price, stock) {
        document.getElementById('editForm').action = `/admin/products/${id}`;
        document.getElementById('edit_sku').value = sku;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_price').value = price;
        document.getElementById('edit_stock').value = stock;
        document.getElementById('editModal').classList.remove('hidden');
    }
    function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }
</script>
@endsection