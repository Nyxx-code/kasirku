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
<body class="bg-slate-50 min-h-screen flex flex-col justify-between relative">

    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#1e4e79_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-100 rounded-full filter blur-[150px] opacity-40 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-amber-100 rounded-full filter blur-[150px] opacity-30 pointer-events-none"></div>

    <div class="p-6">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-400 hover:text-[#1e4e79] transition relative z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Beranda
        </a>
    </div>

    <div class="flex-grow flex items-center justify-center px-4 sm:px-6 relative z-10">
        <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 space-y-8">
            <div class="text-center">
                <span class="text-3xl font-extrabold text-[#1e4e79]">Kasir<span class="text-[#f39200]">Ku</span></span>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight mt-4">Selamat Datang</h2>
                <p class="text-sm text-slate-500 mt-2">Silakan masukkan email dan kata sandi Anda.</p>
            </div>

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl">
                <p class="text-xs text-red-700 font-semibold">{{ $errors->first() }}</p>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Email Pengguna</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" class="w-full pl-4 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-[#1e4e79]/20 focus:border-[#1e4e79] outline-none transition text-sm text-slate-800" required autofocus>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-600">Kata Sandi</label>
                        <a href="#" class="text-xs font-semibold text-[#1e4e79] hover:underline">Lupa password?</a>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="••••••••" class="w-full pl-4 pr-12 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-[#1e4e79]/20 focus:border-[#1e4e79] outline-none transition text-sm text-slate-800" required>
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-[#1e4e79]">
                            <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>
                            <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#1e4e79] text-white font-bold py-4 rounded-xl hover:bg-[#163a5a] transition shadow-lg text-sm">Masuk ke Dashboard</button>
            </form>
        </div>
    </div>

    <div class="text-center text-xs text-slate-400 p-6 relative z-10">
        <p>&copy; 2026 KasirKu POS System.</p>
    </div>

    <script>
        function togglePassword() {
            const p = document.getElementById('password');
            const open = document.getElementById('eye-open');
            const closed = document.getElementById('eye-closed');
            if (p.type === 'password') {
                p.type = 'text';
                closed.classList.add('hidden');
                open.classList.remove('hidden');
            } else {
                p.type = 'password';
                open.classList.add('hidden');
                closed.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>