@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 pb-12">
    
    {{-- Notifikasi --}}
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
        {{-- Header Tabel --}}
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Manajemen Kasir ({{ $cashiers->count() }}/2)</h2>
                <p class="text-xs text-slate-500 mt-0.5">Maksimal 2 kasir.</p>
            </div>
            
            @if($cashiers->count() < 2)
                <button onclick="document.getElementById('cashierModal').classList.remove('hidden')" class="px-4 py-3 rounded-xl text-sm font-bold text-white transition hover:opacity-90 shadow-sm" style="background-color: #0f172a;">
                    + Tambah Kasir
                </button>
            @else
                <span class="px-4 py-2.5 rounded-xl text-sm font-bold bg-slate-200 text-slate-500 cursor-not-allowed">
                    Limit Tercapai
                </span>
            @endif
        </div>
        
        {{-- Tabel Kasir --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr class="text-xs uppercase font-bold text-slate-500 tracking-wider">
                        <th class="p-4 w-16 text-center">No</th>
                        <th class="p-4 w-1/4">Nama Kasir</th>
                        <th class="p-4 w-1/3">Email Akses</th>
                        <th class="p-4 w-24 text-center">Password</th>
                        <th class="p-4 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($cashiers as $cashier)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-4 text-center text-slate-500">{{ $loop->iteration }}</td>
                        <td class="p-4 font-bold text-slate-800">{{ $cashier->name }}</td>
                        <td class="p-4 text-slate-600">{{ $cashier->email }}</td>
                        <td class="p-4 text-center font-mono text-slate-400">••••••••</td>
                        <td class="p-4 text-center flex justify-center gap-3">
                            <button onclick="openEditModal({{ $cashier->id }}, '{{ addslashes($cashier->name) }}', '{{ addslashes($cashier->email) }}')" class="text-blue-600 hover:text-blue-800 text-xs font-semibold">Edit</button>
                            <form action="{{ route('admin.cashiers.destroy', $cashier->id) }}" method="POST" onsubmit="return confirm('Hapus akun staf kasir ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-8 text-center text-slate-400">Belum ada staf kasir terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="cashierModal" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm flex justify-center items-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h2 class="text-lg font-bold text-slate-800">Daftarkan Staf Kasir Baru</h2>
            <button onclick="document.getElementById('cashierModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form action="{{ route('admin.cashiers.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Nama</label><input type="text" name="name" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none" required></div>
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Email</label><input type="email" name="email" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none" required></div>
            <div><label class="block text-xs font-bold uppercase text-slate-600 mb-1">Password</label><input type="password" name="password" class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none" required></div>
            <button type="submit" class="w-full py-3 rounded-xl text-white font-semibold text-sm mt-4" style="background-color: #0f172a;">Simpan Kasir</button>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto">
        
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h2 class="text-lg font-bold text-slate-800">Edit Data Kasir</h2>
            <button onclick="document.getElementById('editModal').classList.add('hidden')"
                class="text-slate-400 hover:text-slate-600">
                ✕
            </button>
        </div>

        <form id="editForm" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                    Nama
                </label>
                <input
                    type="text"
                    id="edit_name"
                    name="name"
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none"
                    required>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                    Email
                </label>
                <input
                    type="email"
                    id="edit_email"
                    name="email"
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none"
                    required>
            </div>

            <p class="text-xs text-slate-400 italic">
                * Kosongkan password jika tidak ingin mengubahnya.
            </p>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                    Password Baru
                </label>
                <input
                    type="password"
                    name="password"
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 outline-none">
            </div>

            <button type="submit" class="w-full py-3 rounded-xl text-white font-semibold text-sm mt-4" style="background-color: #0f172a;">Update data</button>
        </form>

    </div>

</div>

<script>
    function openEditModal(id, name, email) {
        const form = document.getElementById('editForm');
        form.action = `/admin/cashiers/${id}`; 
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('editModal').classList.remove('hidden');
    }
</script>
@endsection