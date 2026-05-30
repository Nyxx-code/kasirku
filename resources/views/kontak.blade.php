<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak KasirKu - Hubungi Kami</title>
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

    <section class="py-16 bg-white text-center border-b border-slate-100">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Hubungi Tim <span class=" font-bold text-[#1e4e79]">Kasir<span class="text-[#f39200]">Ku</span></span></h1>
            <p class="text-slate-600 text-lg">
                Tim kami siap membantu Anda. Silakan isi formulir di bawah ini atau hubungi kami langsung melalui kontak yang tersedia jika Anda butuh bantuan, memiliki pertanyaan teknis, atau ingin berkonsultasi mengenai paket harga.
            </p>
        </div>
    </section>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
                
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-[#1e4e79] mb-6">Kirim Pesan</h3>
                        
                        <form action="#" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                                    <input type="text" placeholder="Masukkan nama Anda" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#1e4e79] focus:border-[#1e4e79] outline-none transition" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Email Bisnis</label>
                                    <input type="email" placeholder="email@bisnisanda.com" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#1e4e79] focus:border-[#1e4e79] outline-none transition" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Toko (Bisnis)</label>
                                    <input type="text" placeholder="Contoh: Toko Maju Jaya" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#1e4e79] focus:border-[#1e4e79] outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Nomor WhatsApp</label>
                                    <input type="tel" placeholder="0812-XXXX-XXXX" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#1e4e79] focus:border-[#1e4e79] outline-none transition" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Subjek</label>
                                <input type="text" 
                                       name="subjek"
                                       value="{{ request('paket') ? '[Pendaftaran] Minat Paket ' . request('paket') . ' - KasirKu' : '' }}" 
                                       placeholder="Pertanyaan tentang harga / Bantuan teknis" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#1e4e79] focus:border-[#1e4e79] outline-none transition" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Pesan</label>
                                <textarea name="pesan" 
                                          rows="5" 
                                          placeholder="Tuliskan detail pertanyaan atau keluhan Anda di sini..." 
                                          class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#1e4e79] focus:border-[#1e4e79] outline-none transition resize-none" required>{{ request('paket') ? 'Halo Tim KasirKu, saya tertarik untuk mendaftarkan toko saya menggunakan Paket ' . request('paket') . '. Mohon informasi langkah pembayaran dan aktivasi selanjutnya.' : '' }}</textarea>
                            </div>

                            <button type="submit" class="w-full bg-[#f39200] text-white font-bold py-4 rounded-xl hover:bg-[#d88100] transition shadow-lg flex justify-center items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                </svg>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="bg-[#1e4e79] text-white p-8 md:p-12 rounded-3xl shadow-xl flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-6">Informasi Kontak</h3>
                        <p class="text-slate-200 text-sm mb-8 leading-relaxed">Punya pertanyaan lebih lanjut mengenai sistem KasirKu? Hubungi kami langsung atau kunjungi kantor operasional kami.</p>

                        <div class="space-y-8">
                            <div class="flex items-start gap-4">
                                <div class="bg-white/10 p-3 rounded-xl flex-shrink-0">
                                    <svg class="w-6 h-6 text-[#f39200]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-base">Alamat Kantor</h4>
                                    <p class="text-slate-200 text-sm mt-1 leading-relaxed">
                                        Jl. Jenderal A. Yani No.47, Langkai, Kec. Pahandut, Kota Palangka Raya, Kalimantan Tengah 73111
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="bg-white/10 p-3 rounded-xl flex-shrink-0">
                                    <svg class="w-6 h-6 text-[#f39200]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-base">WhatsApp Bisnis</h4>
                                    <p class="text-slate-200 text-xs mb-1">Klik nomor di bawah ini untuk memulai obrolan langsung:</p>
                                    <a href="https://wa.me/6281234567890?text={{ urlencode(request('paket') ? 'Halo Tim KasirKu, saya tertarik dengan Paket ' . request('paket') . '. Bagaimana langkah aktivasi selanjutnya?' : 'Halo Tim KasirKu, saya ingin bertanya tentang sistem kasir online.') }}" 
                                       target="_blank" 
                                       class="inline-flex items-center gap-2 text-[#f39200] hover:text-white font-bold text-lg transition">
                                        <span>+62 895-1357-9525</span>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.003 5.37 5.374 0 12.001 0c3.212.001 6.231 1.253 8.5 3.527 2.27 2.274 3.52 5.294 3.518 8.505-.003 6.63-5.37 12.003-11.997 12.003-1.994-.001-3.951-.5-5.688-1.448L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.42 9.863-9.864.001-2.63-1.023-5.101-2.884-6.963C16.521 1.86 14.05 .836 11.417.836c-5.44 0-9.866 4.42-9.869 9.866-.001 1.648.434 3.254 1.258 4.678l-.168.616-1.003 3.66 3.746-.983.626.371z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="bg-white/10 p-3 rounded-xl flex-shrink-0">
                                    <svg class="w-6 h-6 text-[#f39200]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-base">Email Dukungan</h4>
                                    <a href="mailto:support@kasirku.id" class="text-slate-200 hover:text-[#f39200] text-sm mt-1 block transition">support@kasirku.id</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 pt-6 border-t border-white/10 text-xs text-slate-300 italic flex justify-between items-center">
                        <span>Jam Operasional: Senin - Sabtu</span>
                        <span>08.00 - 17.00 WIB</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-slate-200 py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-2xl font-bold text-[#1e4e79]">Kasir<span class="text-[#f39200]">Ku</span></span>
            <p class="mt-4 text-slate-500 text-sm italic">&copy; 2026 KasirKu POS System. Membantu UMKM Naik Kelas.</p>
        </div>
    </footer >


    @if(session('success'))
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"></div>

        <div class="relative w-full max-w-md p-6 mx-auto bg-white rounded-3xl shadow-2xl z-10 border border-slate-100 transform transition-all scale-100 animate-in fade-in zoom-in-95 duration-200">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-50 text-[#1e4e79] mb-4">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                
                <h3 class="text-2xl font-bold text-slate-900 mb-2">Pesan Terkirim!</h3>
                <p class="text-sm text-slate-500 leading-relaxed px-2">
                    {{ session('success') }}
                </p>
                
                <div class="mt-6">
                    <button onclick="closeModal()" type="button" class="w-full bg-[#1e4e79] text-white font-semibold py-3 px-4 rounded-xl hover:bg-[#163a5a] transition shadow-md outline-none">
                        Selesai
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closeModal() {
            const modal = document.getElementById('successModal');
            if (modal) {
                modal.classList.add('hidden');
            }
        }
    </script>
    @endif

    
</body>
</html>