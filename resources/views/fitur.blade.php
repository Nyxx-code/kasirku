<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitur KasirKu - Sistem POS Terbaik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold text-[#1e4e79]">Kasir<span class="text-[#f39200]">Ku</span></span>
                </div>
               <div class="hidden md:flex space-x-8 text-sm font-medium">
    <a href="{{ url('/') }}" class="transition {{ request()->is('/') ? 'text-[#1e4e79] font-semibold border-b-2 border-[#1e4e79] pb-1' : 'text-slate-600 hover:text-[#1e4e79]' }}">
        Beranda
    </a>
    
    <a href="{{ url('/fitur') }}" class="transition {{ request()->is('fitur') ? 'text-[#1e4e79] font-semibold border-b-2 border-[#1e4e79] pb-1' : 'text-slate-600 hover:text-[#1e4e79]' }}">
        Fitur
    </a>
    
    <a href="{{ url('/harga') }}" class="transition {{ request()->is('harga') ? 'text-[#1e4e79] font-semibold border-b-2 border-[#1e4e79] pb-1' : 'text-slate-600 hover:text-[#1e4e79]' }}">
        Harga
    </a>
    
    <a href="{{ url('/kontak') }}" class="transition {{ request()->is('kontak') ? 'text-[#1e4e79] font-semibold border-b-2 border-[#1e4e79] pb-1' : 'text-slate-600 hover:text-[#1e4e79]' }}">
        Kontak
    </a>
</div>
                <div>
                    <a href="login" class="bg-[#1e4e79] text-white px-6 py-2 rounded-full font-semibold hover:bg-[#163a5a] transition shadow-md">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold text-slate-900 leading-tight">
                Fitur Unggulan <span class=" font-bold text-[#1e4e79]">Kasir<span class="text-[#f39200]">Ku</span></span>
            </h1>
            <p class="mt-4 text-xl text-slate-600 max-w-2xl mx-auto">
                Sistem Kasir Online Terbaik untuk Efisiensi Bisnis Anda.
            </p>
        </div>
    </section>

    <section class="py-24 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="group p-8 rounded-2xl border border-slate-100 bg-white  hover:border-[#f39200] hover:shadow-2xl transition duration-300">
                    <div class="w-20 h-20  bg-orange-50 text-[#f39200] rounded-3xl flex items-center justify-center mb-8 mx-auto group-hover:bg-[#f39200] group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-center">Transaksi Cepat & Mudah</h3>
                    <p class="text-slate-600 text-sm text-center leading-relaxed">
                        Proses penjualan instan & hitung total pembayaran dalam detik. Input produk intuitif untuk kasir Anda, cetak struk otomatis.
                    </p>
                </div>
                <div class="group p-8 rounded-2xl border border-slate-100 bg-white hover:border-[#f39200] hover:shadow-2xl transition duration-300">
                    <div class="w-20 h-20 bg-orange-50 text-[#f39200] rounded-3xl flex items-center justify-center mb-8 mx-auto group-hover:bg-[#f39200] group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-center">Manajemen Stok Real-Time</h3>
                    <p class="text-slate-600 text-sm text-center leading-relaxed">
                        Kelola inventori secara otomatis setiap transaksi selesai. Notifikasi stok rendah, mutasi produk, dan pemantauan gudang.
                    </p>
                </div>
                <div class="group p-8 rounded-2xl border border-slate-100 bg-white hover:border-[#f39200] hover:shadow-2xl transition duration-300">
                    <div class="w-20 h-20  bg-orange-50 text-[#f39200] rounded-3xl flex items-center justify-center mb-8 mx-auto group-hover:bg-[#f39200] group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-center">Laporan Penjualan Otomatis</h3>
                    <p class="text-slate-600 text-sm text-center leading-relaxed">
                        Pantau omzet harian & bulanan dengan mudah & cepat. Laporan laba rugi, laporan kasir, dan analisis performa produk.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-16 text-[#f39200] italic">Peran Role</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
                
                <div class="bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-[#1e4e79] rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-2xl ">Dashboard Kasir</h4>
                            <p class="text-slate-400 text-sm">Fokus Pelayanan & Transaksi</p>
                        </div>
                    </div>
                    <p class="text-slate-400 mb-6Leading-relaxed">
                        Antarmuka intuitif yang didesain khusus untuk kecepatan kasir Anda. Minim klik, maksimal pelayanan.
                    </p>
                    <ul class="space-y-3 text-sm text-slate-300 italic mt-3.5">
                        <li class="flex gap-2 items-center mt-7"><div class="w-1.5 h-1.5 bg-[#f39200] rounded-full"></div>Input Produk Cepat & Akurat</li>
                        <li class="flex gap-2 items-center"><div class="w-1.5 h-1.5 bg-[#f39200] rounded-full"></div>Perhitungan Total & Kembalian</li>
                        
                    </ul>
                </div>

                <div class="bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-[#f39200] rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-2xl">Dashboard Admin</h4>
                            <p class="text-slate-400 text-sm">Kendali & Analisis Bisnis</p>
                        </div>
                    </div>
                    <p class="text-slate-400 mb-6 leading-relaxed">
                        Pusat kontrol penuh bisnis Anda. Kelola produk, pantau stok, dan analisis laporan keuangan secara mendalam.
                    </p>
                    <ul class="space-y-3 text-sm text-slate-300 italic">
                        <li class="flex gap-2 items-center"><div class="w-1.5 h-1.5 bg-[#1e4e79] rounded-full"></div>Manajemen Produk & Harga</li>
                        <li class="flex gap-2 items-center"><div class="w-1.5 h-1.5 bg-[#1e4e79] rounded-full"></div>Pemantauan Stok Real-Time</li>
                        <li class="flex gap-2 items-center"><div class="w-1.5 h-1.5 bg-[#1e4e79] rounded-full"></div>Laporan Keuangan Mendalam</li>
                    </ul>
                </div>
                
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6 text-slate-900">Tingkatkan Efisiensi Bisnis Anda Hari Ini.</h2>
            <p class="text-slate-600 mb-10 max-w-xl mx-auto">Daftar sekarang untuk akses penuh fitur KasirKu.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="border-2 border-[#1e4e79] text-[#1e4e79] px-8 py-4 rounded-xl font-bold hover:bg-[#1e4e79] hover:text-white transition"><a href="{{ url('/harga') }}">Daftar Sekarang</a></button>
            </div>
        </div>
    </section>

     <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-200 py-10 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-2xl font-bold text-[#1e4e79]">Kasir<span class="text-[#f39200]">Ku</span></span>
            <p class="mt-3 text-slate-500 text-sm font-medium">&copy; 2026 KasirKu POS System. Membantu UMKM Naik Kelas.</p>
        </div>
    </footer>

</body>
</html>