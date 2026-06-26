@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-12">

    @if(session('status'))
        <div class="bg-green-50 border border-green-200 p-4 rounded-xl text-green-700 font-medium shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 p-4 rounded-xl text-red-700 text-sm shadow-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        
        {{-- HEADER TABEL (Judul dan Tombol Menyatu di Sini) --}}
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center bg-white gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Data Pendaftaran Admin</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola akun admin.</p>
            </div>
            
            <button onclick="openModal()" class="px-5 py-3 rounded-xl text-sm font-bold text-white shadow-sm hover:opacity-90 transition whitespace-nowrap" style="background-color: #0f172a;">
                + Tambah Akun Baru
            </button>
        </div>

        {{-- BAGIAN TABEL --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-xs uppercase font-bold text-slate-500 tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="p-4 w-12 text-center">No</th>
                        <th class="p-4">Nama Admin</th>
                        <th class="p-4">Email Akses</th>
                        <th class="p-4 text-center">Password</th>
                        <th class="p-4">Nomor HP</th>
                        <th class="p-4">Nama Toko</th>
                        <th class="p-4 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-sm">
                    @forelse($admins as $admin)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-4 text-center text-slate-500 font-medium">{{ $loop->iteration }}</td>
                        <td class="p-4 font-bold text-slate-800">{{ $admin->name }}</td>
                        <td class="p-4 text-slate-500">{{ $admin->email }}</td>
                        <td class="p-4 text-center font-mono text-slate-400 tracking-widest">••••••••</td>
                        <td class="p-4 text-slate-600 font-medium">{{ $admin->phone_number ?? '-' }}</td>
                        <td class="p-4 text-slate-700 font-medium">{{ $admin->store_name }}</td>
                        
                        {{-- TOMBOL AKSI LANGSUNG TERLIHAT --}}
                        <td class="p-4 text-center flex justify-center gap-3">
                            <button onclick="openEditModal({{ $admin->id }}, '{{ addslashes($admin->name) }}', '{{ addslashes($admin->email) }}', '{{ $admin->phone_number ?? '' }}', '{{ addslashes($admin->store_name) }}')" class="text-slate-800 hover:text-slate-600 font-bold text-xs transition">
                                Edit
                            </button>

                            <form action="{{ route('developer.delete.admin', $admin->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ addslashes($admin->name) }}? Tindakan ini tidak bisa dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-xs transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-12 text-center text-slate-400">
                            Belum ada data admin yang didaftarkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="registerModal" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm flex justify-center items-center p-4 transition-opacity">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform scale-95 transition-transform" id="modalContent">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h2 class="text-xl font-bold text-slate-800">Registrasi Admin Baru</h2>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition">✕</button>
        </div>
        <form action="{{ route('developer.register.admin.submit') }}" method="POST" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf
            <div><label class="block text-sm font-semibold text-slate-700 mb-1">Nama Admin</label><input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]" required></div>
            <div><label class="block text-sm font-semibold text-slate-700 mb-1">Akun (Email)</label><input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]" required></div>
            <div><label class="block text-sm font-semibold text-slate-700 mb-1">Password</label><input type="password" name="password" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]" required></div>
            <div><label class="block text-sm font-semibold text-slate-700 mb-1">Konfirmasi Password</label><input type="password" name="password_confirmation" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]" required></div>
            <div><label class="block text-sm font-semibold text-slate-700 mb-1">Nomor HP</label><input type="text" name="phone_number" value="{{ old('phone_number') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]" required></div>
            <div><label class="block text-sm font-semibold text-slate-700 mb-1">Nama Toko</label><input type="text" name="store_name" value="{{ old('store_name') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]" required></div>
            
            <div class="pt-4 flex gap-3">
                <button type="button" onclick="closeModal()" class="flex-1 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-3 rounded-xl text-white font-bold hover:opacity-90 transition shadow-md" style="background-color: #0f172a;">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm flex justify-center items-center p-4 transition-opacity">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform scale-95 transition-transform" id="editModalContent">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h2 class="text-xl font-bold text-slate-800">Edit Data Admin</h2>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 transition">✕</button>
        </div>
        
        <form id="editForm" method="POST" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
            @csrf
            @method('PUT')
            
            <div><label class="block text-sm font-semibold text-slate-700 mb-1">Nama Admin</label><input type="text" id="edit_name" name="name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]" required></div>
            <div><label class="block text-sm font-semibold text-slate-700 mb-1">Akun (Email)</label><input type="email" id="edit_email" name="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]" required></div>
            
            <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 mt-2">
                <p class="text-xs text-slate-500 font-medium mb-2">Kosongkan kolom password di bawah jika tidak ingin menggantinya.</p>
                <div><label class="block text-sm font-semibold text-slate-700 mb-1">Password Baru (Opsional)</label><input type="password" name="password" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]"></div>
                <div class="mt-3"><label class="block text-sm font-semibold text-slate-700 mb-1">Konfirmasi Password Baru</label><input type="password" name="password_confirmation" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]"></div>
            </div>

            <div><label class="block text-sm font-semibold text-slate-700 mb-1">Nomor HP</label><input type="text" id="edit_phone_number" name="phone_number" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]" required></div>
            <div><label class="block text-sm font-semibold text-slate-700 mb-1">Nama Toko</label><input type="text" id="edit_store_name" name="store_name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-[#1e4e79]" required></div>

            <div class="pt-4 flex gap-3">
                <button type="button" onclick="closeEditModal()" class="flex-1 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-3 rounded-xl text-white font-bold hover:opacity-90 transition shadow-md" style="background-color: #0f172a;">Update Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        const modal = document.getElementById('registerModal');
        const content = document.getElementById('modalContent');
        modal.classList.remove('hidden');
        setTimeout(() => content.classList.replace('scale-95', 'scale-100'), 10);
    }
    function closeModal() {
        const modal = document.getElementById('registerModal');
        const content = document.getElementById('modalContent');
        content.classList.replace('scale-100', 'scale-95');
        setTimeout(() => modal.classList.add('hidden'), 150);
    }

    function openEditModal(id, name, email, phone, store) {
        document.getElementById('editForm').action = `/developer/delete-admin/${id}`.replace('delete', 'update');
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_phone_number').value = phone;
        document.getElementById('edit_store_name').value = store;

        const modal = document.getElementById('editModal');
        const content = document.getElementById('editModalContent');
        modal.classList.remove('hidden');
        setTimeout(() => content.classList.replace('scale-95', 'scale-100'), 10);
    }
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        const content = document.getElementById('editModalContent');
        content.classList.replace('scale-100', 'scale-95');
        setTimeout(() => modal.classList.add('hidden'), 150);
    }
    
    @if($errors->any() && !old('_method'))
        openModal();
    @endif
</script>
@endsection