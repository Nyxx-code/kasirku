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

    <!-- NAVBAR -->
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

    <!-- HERO SECTION -->
    <section class="pt-16 pb-8 bg-slate-50 text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Satu Harga, <span class="text-[#f39200]">Semua Fitur Premium</span></h1>
            <p class="text-slate-600 text-lg max-w-2xl mx-auto">Tidak perlu bingung memilih. Kami merancang satu paket lengkap yang paling optimal untuk mengelola dan membesarkan bisnis Anda.</p>
        </div>
    </section>

    <!-- PRICING SECTION -->
    <section class="py-10 pb-20">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- SINGLE PRICING CARD -->
            <div class="bg-white p-8 sm:p-10 rounded-3xl border-2 border-[#f39200] shadow-2xl relative flex flex-col justify-between transform transition duration-300 hover:-translate-y-1">
                
                <!-- Ribbon Label -->
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#f39200] text-white text-xs font-bold px-5 py-1.5 rounded-full uppercase tracking-widest shadow-md">
                    Paket Lengkap (PRO)
                </div>
                
                <!-- Header Card -->
                <div class="text-center mt-2 mb-8">
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">KasirKu Pro</h3>
                    <p class="text-slate-500 text-sm mb-6">Solusi cerdas untuk retail, F&B, dan jasa.</p>
                    <div class="flex items-end justify-center gap-1">
                        <span class="text-4xl font-black text-[#1e4e79]">Rp 350.000</span>
                        <span class="text-slate-400 font-medium mb-1"> / bulan</span>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="border-slate-100 mb-8">
                
                <!-- Features List -->
                <ul class="space-y-4 mb-10 text-sm text-slate-700 font-medium">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#f39200] shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        1 Akun Admin & 2 Akun Kasir
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#f39200] shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Sistem Manajemen Stok Otomatis
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#f39200] shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Laporan Penjualan & Laba Rugi Detail
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-[#f39200] shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Pencatatan Pembayaran Tunai & Transfer Manual
                    </li>
                   
                </ul>
                
                <!-- CTA Button -->
                <a href="{{ url('/kontak?paket=Pro') }}" class="block text-center bg-[#f39200] text-white py-3.5 rounded-xl font-bold hover:bg-[#d88100] transition mt-auto shadow-lg shadow-orange-500/30">
                    Daftar Sekarang
                </a>
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