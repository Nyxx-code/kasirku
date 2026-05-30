<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harga Paket KasirKu - Solusi POS Terjangkau</title>
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
                    <a href="/login" class="bg-[#1e4e79] text-white px-6 py-2 rounded-full font-semibold hover:bg-[#163a5a] transition shadow-md">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="py-16 bg-white text-center">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Pilih Paket <span class=" font-bold text-[#1e4e79]">Kasir<span class="text-[#f39200]">Ku</span></span> yang Tepat</h1>
            <p class="text-slate-600 text-lg max-w-2xl mx-auto italic">Investasi cerdas untuk efisiensi operasional dan pertumbuhan bisnis Anda.</p>
            
        </div>
    </section>

    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition duration-300 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Paket Standar</h3>
                        <p class="text-slate-500 text-sm mb-6">Cocok untuk toko kecil atau warung pemula.</p>
                        <div class="mb-8">
                            <span class="text-3xl font-extrabold text-[#1e4e79]">Rp 150.000</span>
                            <span class="text-slate-400 text-sm italic"> / bulan</span>
                        </div>
                        <ul class="space-y-4 mb-8 text-sm">
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> 1 Toko / Cabang</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> 1 Akun Kasir</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> Transaksi Penjualan Dasar</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> Laporan Harian</li>
                        </ul>
                    </div>
                    <a href="{{ url('/kontak?paket=Standar') }}" class="block text-center w-full py-3 rounded-xl border-2 border-[#1e4e79] text-[#1e4e79] font-bold hover:bg-[#1e4e79] hover:text-white transition mt-auto">
                        Pilih Paket Standar
                    </a>
                </div>

                <div class="bg-white p-8 rounded-3xl border-2 border-[#f39200] shadow-2xl relative transform scale-105 z-10 flex flex-col justify-between">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#f39200] text-white text-xs font-bold px-4 py-1 rounded-full uppercase tracking-widest">Paling Populer</div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Paket Pro</h3>
                        <p class="text-slate-500 text-sm mb-6">Untuk bisnis berkembang dengan banyak stok.</p>
                        <div class="mb-8">
                            <span class="text-3xl font-extrabold text-[#1e4e79]">Rp 350.000</span>
                            <span class="text-slate-400 text-sm italic"> / bulan</span>
                        </div>
                        <ul class="space-y-4 mb-8 text-sm">
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> Hingga 3 Toko / Cabang</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> 5 Akun Kasir & Admin</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> Manajemen Stok (Inventori)</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> Laporan Lengkap (Laba/Rugi)</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> Integrasi Pembayaran Digital</li>
                        </ul>
                    </div>
                    <a href="{{ url('/kontak?paket=Pro') }}" class="block text-center bg-[#f39200] text-white py-3 rounded-xl font-bold hover:bg-[#d88100] transition mt-auto">
                        Pilih Paket Pro
                    </a>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition duration-300 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Paket Enterprise</h3>
                        <p class="text-slate-500 text-sm mb-6">Solusi skala besar untuk jaringan bisnis luas.</p>
                        <div class="mb-8">
                            <span class="text-3xl font-extrabold text-[#1e4e79]">Rp 750.000</span>
                            <span class="text-slate-400 text-sm italic"> / bulan</span>
                        </div>
                        <ul class="space-y-4 mb-8 text-sm">
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> Cabang Tak Terbatas</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> Pengguna Tak Terbatas</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> Manajemen Multi-Cabang</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> API Integrasi</li>
                            <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> Dukungan Prioritas 24/7</li>
                        </ul>
                    </div>
                    <a href="{{ url('/kontak?paket=Enterprise') }}" class="block text-center w-full py-3 rounded-xl border-2 border-[#1e4e79] text-[#1e4e79] font-bold hover:bg-[#1e4e79] hover:text-white transition mt-auto">
                        Pilih Paket Enterprise
                    </a>
                </div>

            </div>
        </div>
    </section>

   

    <footer class="bg-white border-t border-slate-200 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-2xl font-bold text-[#1e4e79]">Kasir<span class="text-[#f39200]">Ku</span></span>
            <p class="mt-4 text-slate-500 text-sm italic">&copy; 2026 KasirKu POS System. Membantu UMKM Naik Kelas.</p>
        </div>
    </footer>

</body>
</html>