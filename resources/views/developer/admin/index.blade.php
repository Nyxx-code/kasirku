@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-4">
    
    <div class="flex flex-col items-center text-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Akun Admin</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola dan pantau semua akun admin toko/klien yang terdaftar.</p>
        </div>
        <div>
            <a href="{{ route('developer.register.admin') }}" class="inline-flex items-center gap-2 bg-[#1e4e79] text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-[#133554] transition shadow-md shadow-[#1e4e79]/10" style="background-color: #1e4e79 !important; color: #ffffff !important;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambahkan Akun
            </a>
        </div>
    </div>
<br>
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-600 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Nama Admin</th>
                        <th class="px-6 py-4">Nama Toko</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4 font-semibold text-slate-800">Nama Klien</td>
                        <td class="px-6 py-4">Gunung Media Computer</td>
                        <td class="px-6 py-4 text-slate-500">admin@gunungmedia.com</td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs font-medium bg-green-50 text-green-600 px-2.5 py-1 rounded-full">Aktif</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection