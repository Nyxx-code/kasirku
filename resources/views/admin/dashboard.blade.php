@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Dashboard Utama</h1>
            <p class="text-slate-500 text-sm">Monitor performa toko Anda.</p>
        </div>
        
        <a href="{{ route('admin.reports.index') }}" class="bg-[#1e4e79] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#163a5a] transition flex items-center gap-2 shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Lihat Laporan Lengkap
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-slate-700">Grafik Omzet</h3>
                <select id="omzetFilter" class="bg-slate-50 border border-slate-200 text-xs font-bold text-slate-600 rounded-lg px-3 py-1 outline-none">
                    <option value="harian">Harian</option>
                    <option value="mingguan" selected>Mingguan</option>
                    <option value="bulanan">Bulanan</option>
                </select>
            </div>
            <div class="h-64">
                <canvas id="omzetChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-slate-700">Volume Transaksi</h3>
                <select id="transaksiFilter" class="bg-slate-50 border border-slate-200 text-xs font-bold text-slate-600 rounded-lg px-3 py-1 outline-none">
                    <option value="harian">Harian</option>
                    <option value="mingguan" selected>Mingguan</option>
                    <option value="bulanan">Bulanan</option>
                </select>
            </div>
            <div class="h-64">
                <canvas id="transaksiChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Grafik Omzet (Line)
    const ctxOmzet = document.getElementById('omzetChart').getContext('2d');
    new Chart(ctxOmzet, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Omzet (Rp)',
                data: [500000, 750000, 600000, 900000, 1200000, 1500000, 1100000],
                borderColor: '#1e4e79',
                backgroundColor: 'rgba(30, 78, 121, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 3
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });

    // 2. Grafik Volume Transaksi (Bar)
    const ctxTransaksi = document.getElementById('transaksiChart').getContext('2d');
    new Chart(ctxTransaksi, {
        type: 'bar',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Total Transaksi',
                data: [12, 19, 15, 25, 30, 22, 18],
                backgroundColor: '#f59e0b',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, grid: { display: false } }, x: { grid: { display: false } } }
        }
    });
</script>
@endsection