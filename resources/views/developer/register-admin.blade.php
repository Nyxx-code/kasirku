@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Registrasi Admin Baru</h1>
            <p class="text-slate-500 text-sm">Silakan isi data untuk membuat akun admin baru.</p>
        </div>

        <form action="{{ route('developer.register.admin.submit') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-slate-900 outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-slate-900 outline-none" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-slate-900 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-slate-900 outline-none" required>
                </div>
            </div>

            <div class="pt-4 flex gap-3">
                <a href="{{ route('developer.dashboard') }}" class="flex-1 text-center py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition">
                    Batal
                </a>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-slate-900 text-white font-semibold hover:bg-slate-800 transition shadow-lg">
                    Buat Akun Admin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection