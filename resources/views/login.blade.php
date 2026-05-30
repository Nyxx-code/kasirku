<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - KasirKu POS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex">

    <div class="hidden lg:flex lg:w-1/2 bg-[#1e4e79] relative items-center justify-center p-12 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#f39200] rounded-full filter blur-[120px] opacity-20"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-blue-400 rounded-full filter blur-[120px] opacity-20"></div>

        <div class="relative max-w-md z-10">
            <span class="text-3xl font-extrabold text-white">Kasir<span class="text-[#f39200]">Ku</span></span>
            <h1 class="text-4xl font-extrabold text-white tracking-tight mt-6 leading-tight">
                Kelola Penjualan Bisnis Jauh Lebih Mudah.
            </h1>
            <p class="text-blue-100/80 mt-4 text-base leading-relaxed">
                Pantau transaksi real-time, manajemen stok otomatis, dan pantau performa tokomu dalam satu dashboard terintegrasi.
            </p>
            <div class="mt-8 flex items-center gap-3 text-sm text-blue-200/50 font-mono">
                <span>⚡ KasirKu Engine v2.0</span>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-between p-8 sm:p-12 md:p-20 bg-white relative">
        
        <div class="flex justify-between items-center">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-400 hover:text-[#1e4e79] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Beranda
            </a>
        </div>

        <div class="w-full max-w-md mx-auto my-auto space-y-8">
            <div>
                <div class="lg:hidden mb-4">
                    <span class="text-3xl font-extrabold text-[#1e4e79]">Kasir<span class="text-[#f39200]">Ku</span></span>
                </div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h2>
                <p class="text-sm text-slate-500 mt-2">Silakan masukkan email dan kata sandi Anda untuk masuk ke sistem.</p>
            </div>

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span class="text-sm font-semibold text-red-800">Gagal Masuk</span>
                </div>
                <p class="text-xs text-red-700 mt-1 pl-7">{{ $errors->first() }}</p>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Email Pengguna</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-[#1e4e79]/20 focus:border-[#1e4e79] outline-none transition text-sm text-slate-800 placeholder-slate-400 font-medium" required autofocus>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Kata Sandi</label>
                        <a href="#" class="text-xs font-semibold text-[#1e4e79] hover:underline">Lupa password?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input type="password" name="password" placeholder="••••••••" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-[#1e4e79]/20 focus:border-[#1e4e79] outline-none transition text-sm text-slate-800 placeholder-slate-400 font-medium" required>
                    </div>
                </div>

                <div class="flex items-center">
                    <label class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer select-none font-medium">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-[#1e4e79] focus:ring-[#1e4e79]/30">
                        Biarkan saya tetap masuk
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#1e4e79] text-white font-bold py-4 rounded-xl hover:bg-[#163a5a] active:scale-[0.99] transition shadow-lg flex justify-center items-center gap-2 text-sm tracking-wide">
                        Masuk ke Dashboard
                        <svg xmlns="http://www.w3.org/2000/xl" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center text-xs text-slate-400 mt-8">
            <p>&copy; 2026 KasirKu POS System. Membantu UMKM Naik Kelas.</p>
        </div>
    </div>

</body>
</html>