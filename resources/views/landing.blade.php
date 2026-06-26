<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasirKu - Kelola Bisnis Lebih Cepat</title>
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
                    <a href="{{ route('login') }}" class="bg-[#1e4e79] text-white px-6 py-2 rounded-full font-semibold hover:bg-[#163a5a] transition shadow-md">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <section id="beranda" class="relative pt-20 pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center">

            <div class="lg:w-1/2 text-center lg:text-left space-y-6">
                <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 leading-tight">
                    Kelola Bisnis Anda <span class="text-[#1e4e79]">Lebih Cepat</span> & Mudah.
                </h1>

                <p class="text-lg text-slate-600 max-w-xl mx-auto lg:mx-0">
                    Sistem Kasir Online lengkap dengan manajemen stok, laporan otomatis, dan sistem multi-role untuk segala jenis usaha.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ url('/harga') }}" class="inline-block text-center border-2 border-[#1e4e79] text-[#1e4e79] px-8 py-4 rounded-xl font-bold hover:bg-[#1e4e79] hover:text-white transition">
                        Daftar Sekarang
                    </a>
                </div>

            </div>

            <div class="lg:w-1/2 mt-12 lg:mt-0 relative">
                <div class="bg-white p-4 rounded-2xl shadow-2xl border border-slate-100 rotate-2 hover:rotate-0 transition duration-500">
                    <div class="bg-slate-100 rounded-lg h-64 md:h-80 flex items-center justify-center overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556742044-3c52d6e88c62?auto=format&fit=crop&q=80&w=800" alt="Dashboard Preview" class="object-cover w-full h-full opacity-80">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-16 text-slate-900">Fitur Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="group p-8 rounded-2xl border border-slate-100 hover:border-[#1e4e79] hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-50 text-[#1e4e79] rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:bg-[#1e4e79] group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Transaksi Cepat</h3>
                    <p class="text-slate-500 text-sm">Proses pembayaran instan dengan input produk yang intuitif untuk kasir Anda.</p>
                </div>
                <div class="group p-8 rounded-2xl border border-slate-100 hover:border-[#1e4e79] hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-50 text-[#1e4e79] rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:bg-[#1e4e79] group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Stok Real-Time</h3>
                    <p class="text-slate-500 text-sm">Kelola inventori secara otomatis setiap kali ada transaksi yang terjual.</p>
                </div>
                <div class="group p-8 rounded-2xl border border-slate-100 hover:border-[#1e4e79] hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-50 text-[#1e4e79] rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:bg-[#1e4e79] group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Laporan Otomatis</h3>
                    <p class="text-slate-500 text-sm">Pantau omzet harian, mingguan, hingga bulanan hanya dengan satu klik.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2">
                <h3 class="text-4xl font-bold mb-6">Satu Login, Dua Peran Berbeda.</h3>
                <p class="text-slate-400 mb-8 leading-relaxed">
                    Sistem kami mendeteksi siapa Anda secara otomatis. Tak perlu ribet, keamanan terjaga sesuai hak akses masing-masing.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 italic">
                        <div class="w-2 h-2 bg-[#f39200] rounded-full"></div> 
                        <span><b class="text-white">Admin:</b> Kelola produk dan laporan penuh bisnis Anda.</span>
                    </li>
                    <li class="flex items-center gap-3 italic">
                        <div class="w-2 h-2 bg-[#f39200] rounded-full"></div> 
                        <span><b class="text-white">Kasir:</b> Fokus pada pelayanan dan transaksi cepat.</span>
                    </li>
                </ul>
            </div>
            <div class="md:w-1/2 grid grid-cols-2 gap-4">
                <div class="bg-slate-800 p-6 rounded-xl border border-slate-700">
                    <p class="text-3xl font-bold text-[#f39200]">150+</p>
                    <p class="text-slate-400 text-sm">Bisnis Terdaftar</p>
                </div>
                <div class="bg-slate-800 p-6 rounded-xl border border-slate-700">
                    <p class="text-3xl font-bold text-[#f39200]">100%</p>
                    <p class="text-slate-400 text-sm">Data Aman (MySQL)</p>
                </div>
                <div class="bg-slate-800 p-6 rounded-xl border border-slate-700 col-span-2">
                    <p class="text-3xl font-bold text-[#f39200]">24/7</p>
                    <p class="text-slate-400 text-sm">Sistem Cloud Aktif</p>
                </div>
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