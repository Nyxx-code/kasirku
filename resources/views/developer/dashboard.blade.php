@extends('layouts.app')

@section('content')
<div class="p-6 space-y-8">
    
    

    <!-- NOTIFIKASI FLASH -->
    @if (session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm animate-fade-in">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm font-semibold">{{ session('status') }}</span>
        </div>
    @endif

    <!-- 1. GRAFIK JUMLAH AKUN ADMIN YANG MENDAFTAR (HARIAN & BULANAN) -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="font-bold text-slate-700">Grafik Jumlah Admin Mendaftar</h3>
                <p class="text-slate-400 text-xs mt-0.5">Memantau volume pendaftaran admin baru pada periode tertentu.</p>
            </div>
            <div class="flex bg-slate-100 p-1 rounded-xl">
                <button id="btnAkunHarian" class="px-4 py-1.5 text-xs font-bold rounded-lg bg-white text-slate-700 shadow-sm transition">Harian</button>
                <button id="btnAkunBulanan" class="px-4 py-1.5 text-xs font-bold rounded-lg text-slate-500 hover:text-slate-700 transition">Bulanan</button>
            </div>
        </div>
        <div class="h-64">
            <canvas id="akunChart"></canvas>
        </div>
    </div>

    <!-- 2. GRAFIK OMSET DARI ADMIN YANG BAYAR LISENSI -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="font-bold text-slate-700">Grafik Omset Pendapatan Developer</h3>
                <p class="text-slate-400 text-xs mt-0.5">Akumulasi uang masuk dari biaya lisensi aktivasi akun Admin.</p>
            </div>
        </div>
        <div class="h-72">
            <canvas id="omzetDeveloperChart"></canvas>
        </div>
    </div>

</div>

<!-- LIBRARY & LOGIK ENGINE CHARTJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataAkunHarian = {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        admin: [1, 0, 2, 1, 0, 1, 0]
    };
    
    const dataAkunBulanan = {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        admin: [5, 8, 12, 10, 15, 7, 9, 11, 14, 13, 16, 20]
    };

    const ctxAkun = document.getElementById('akunChart').getContext('2d');
    const akunChart = new Chart(ctxAkun, {
        type: 'line',
        data: {
            labels: dataAkunHarian.labels,
            datasets: [
                {
                    label: 'Admin Baru',
                    data: dataAkunHarian.admin,
                    borderColor: '#1e4e79', 
                    backgroundColor: 'rgba(30, 78, 121, 0.05)',
                    borderWidth: 3,
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top', labels: { boxWidth: 12, font: { weight: 'bold' } } } }
        }
    });

    document.getElementById('btnAkunHarian').addEventListener('click', function() {
        toggleActiveButton(this, 'btnAkunBulanan');
        akunChart.data.labels = dataAkunHarian.labels;
        akunChart.data.datasets[0].data = dataAkunHarian.admin;
        akunChart.update();
    });

    document.getElementById('btnAkunBulanan').addEventListener('click', function() {
        toggleActiveButton(this, 'btnAkunHarian');
        akunChart.data.labels = dataAkunBulanan.labels;
        akunChart.data.datasets[0].data = dataAkunBulanan.admin;
        akunChart.update();
    });

    function toggleActiveButton(activeBtn, inactiveBtnId) {
        activeBtn.classList.add('bg-white', 'text-slate-700', 'shadow-sm');
        activeBtn.classList.remove('text-slate-500');
        const inactiveBtn = document.getElementById(inactiveBtnId);
        inactiveBtn.classList.remove('bg-white', 'text-slate-700', 'shadow-sm');
        inactiveBtn.classList.add('text-slate-500');
    }

    const ctxOmzetDev = document.getElementById('omzetDeveloperChart').getContext('2d');
    const gradientGold = ctxOmzetDev.createLinearGradient(0, 0, 0, 300);
    gradientGold.addColorStop(0, '#f59e0b');
    gradientGold.addColorStop(1, 'rgba(245, 158, 11, 0.05)');

    new Chart(ctxOmzetDev, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Omset Masuk (Rp)',
                data: [3500000, 5000000, 7500000, 6000000, 9500000, 5500000, 6500000, 8000000, 7200000, 8800000, 10500000, 12000000], 
                backgroundColor: gradientGold,
                borderColor: '#d97706',
                borderWidth: 1.5,
                borderRadius: 8,
                borderSkipped: 'bottom'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Pendapatan: ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: { callback: function(value) { return 'Rp ' + value.toLocaleString('id-ID'); } }
                }
            }
        }
    });
</script>
@endsection