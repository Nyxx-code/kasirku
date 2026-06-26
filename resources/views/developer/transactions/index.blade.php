@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-6 pb-12">

    {{-- KOTAK METRIK RINGKASAN --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Card Total Omzet --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500 mb-1">Total Omzet Keseluruhan</p>
                <h3 class="text-2xl font-black text-emerald-700">
                    Rp {{ number_format($totalAdmin * 350000, 0, ',', '.') }}
                </h3>
            </div>
        </div>

        {{-- Card Total Admin --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-amber-50 flex items-center justify-center text-amber-500">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500 mb-1">Admin Terdaftar</p>
                <h3 class="text-2xl font-black text-slate-800">
                    {{ number_format($totalAdmin, 0, ',', '.') }} <span class="text-sm font-medium text-slate-400">Admin</span>
                </h3>
            </div>
        </div>

    </div>

    {{-- KOTAK TABEL UTAMA --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        
        {{-- HEADER TABEL (Judul, Filter, & Tombol Export Menyatu) --}}
        <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center bg-white gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Ringkasan Sistem & Riwayat Admin</h2>
                <p class="text-xs text-slate-500 mt-0.5">Pantau daftar admin yang telah mendaftar di sistem.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                {{-- Form Filter Tanggal --}}
                <form action="{{ url()->current() }}" method="GET" class="flex items-center gap-2">
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-3 py-2 rounded-xl border border-slate-200 text-sm outline-none text-slate-600">
                    <span class="text-slate-400 font-medium">-</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-3 py-2 rounded-xl border border-slate-200 text-sm outline-none text-slate-600">
                    <button type="submit" class="px-4 py-2 rounded-xl text-sm font-bold text-white transition hover:opacity-90 shadow-sm" style="background-color: #0f172a;">
                        Filter
                    </button>
                </form>

                <div class="w-px h-8 bg-slate-200 mx-1 hidden md:block"></div>

                {{-- Tombol Export PDF --}}
                <a href="{{ route('developer.transactions.pdf') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-red-50 border border-red-200 text-red-600 shadow-sm hover:bg-red-100 transition whitespace-nowrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export PDF
                </a>
            </div>
        </div>

        {{-- TABEL DATA --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-slate-50 text-xs uppercase font-bold text-slate-500 tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="p-4 w-12 text-center">No</th>
                        <th class="p-4">Nama Admin</th>
                        <th class="p-4">Nama Toko</th>
                        <th class="p-4 text-center">Tanggal Mendaftar</th>
                        <th class="p-4 text-center">Jam Mendaftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-sm">
                    @forelse($admins as $admin)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-4 text-center text-slate-500 font-medium">{{ $loop->iteration }}</td>
                        <td class="p-4 font-bold text-slate-800">{{ $admin->name }}</td>
                        <td class="p-4 text-[#1e4e79] font-bold">{{ $admin->store_name ?? 'Belum Diatur' }}</td>
                        
                        <td class="p-4 text-center">
                            <span class="block text-slate-700 font-medium">
                                {{ \Carbon\Carbon::parse($admin->created_at)->translatedFormat('d F Y') }}
                            </span>
                        </td>
                        
                        <td class="p-4 text-center">
                            <span class="inline-flex px-3 py-1 bg-slate-100 text-slate-600 font-mono text-xs font-bold rounded-md border border-slate-200">
                                {{ \Carbon\Carbon::parse($admin->created_at)->format('H:i') }} WIB
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-slate-400">
                            <p>Belum ada data admin/klien pada periode ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection