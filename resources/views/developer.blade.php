<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Dashboard - KasirKu Engine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .code-font { font-family: 'Fira Code', monospace; }
    </style>
</head>
<body class="bg-[#0f172a] text-slate-200">

    <nav class="bg-[#1e293b] border-b border-slate-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <span class="text-xl font-bold text-white">Kasir<span class="text-[#f39200]">Ku</span></span>
                    <span class="bg-[#1e4e79] text-blue-200 text-xs px-2.5 py-0.5 rounded-md font-mono border border-blue-500/30">DEV_PANEL v2.0</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-white">Dev Environment</p>
                        <p class="text-xs text-emerald-400 flex items-center gap-1 justify-end">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span> Connected to DB
                        </p>
                    </div>
                    <a href="{{ url('/') }}" class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition border border-slate-600">
                        Keluar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Pusat Kendali Sistem & Integrasi API</h1>
            <p class="text-slate-400 mt-2">Pantau lalu lintas webhook, kelola kredensial API paket Enterprise, dan pantau log masuk database.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-[#1e293b] p-6 rounded-2xl border border-slate-800">
                <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Total Request API</p>
                <div class="flex items-baseline gap-2 mt-2">
                    <span class="text-3xl font-bold text-white code-font">142,805</span>
                    <span class="text-xs text-emerald-400 font-medium">+12% /hari</span>
                </div>
            </div>
            <div class="bg-[#1e293b] p-6 rounded-2xl border border-slate-800">
                <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Rata-rata Respon</p>
                <div class="flex items-baseline gap-2 mt-2">
                    <span class="text-3xl font-bold text-white code-font">42ms</span>
                    <span class="text-xs text-emerald-400 font-medium">99.9% Uptime</span>
                </div>
            </div>
            <div class="bg-[#1e293b] p-6 rounded-2xl border border-slate-800">
                <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Pesan Kontak Terarsip</p>
                <div class="flex items-baseline gap-2 mt-2">
                    <span class="text-3xl font-bold text-white code-font">1,248</span>
                    <span class="text-xs text-slate-400 font-medium">Row Data</span>
                </div>
            </div>
            <div class="bg-[#1e293b] p-6 rounded-2xl border border-slate-800">
                <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Auto-Response Mail</p>
                <div class="flex items-baseline gap-2 mt-2">
                    <span class="text-3xl font-bold text-white code-font">100%</span>
                    <span class="text-xs text-emerald-400 font-medium">0 Queue Error</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-[#1e293b] p-6 rounded-3xl border border-slate-800 shadow-xl">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#f39200]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                        API Kredensial (Akses Sandbox)
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase mb-2">Development Client ID</label>
                            <div class="flex gap-2">
                                <input type="text" readonly value="kk_dev_live_8491029481029" class="w-full bg-[#0f172a] border border-slate-800 rounded-xl px-4 py-3 text-sm code-font text-emerald-400 outline-none">
                                <button onclick="alert('Salin Berhasil!')" class="bg-slate-800 hover:bg-slate-700 text-white px-4 rounded-xl text-sm font-medium transition border border-slate-700">Salin</button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase mb-2">Secret Key</label>
                            <div class="flex gap-2">
                                <input type="password" readonly value="••••••••••••••••••••••••••••••••••••" class="w-full bg-[#0f172a] border border-slate-800 rounded-xl px-4 py-3 text-sm code-font text-slate-400 outline-none">
                                <button onclick="alert('Secret Key Dimunculkan!')" class="bg-slate-800 hover:bg-slate-700 text-white px-4 rounded-xl text-sm font-medium transition border border-slate-700">Lihat</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1e293b] p-6 rounded-3xl border border-slate-800 shadow-xl">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            Struktur Objek Skema Database (`contacts_table`)
                        </h3>
                        <span class="bg-slate-800 text-slate-400 text-xs px-2.5 py-1 rounded-md font-mono">JSON Format</span>
                    </div>
                    
                    <div class="bg-[#0f172a] rounded-2xl p-5 border border-slate-800 overflow-x-auto">
                        <pre class="code-font text-sm text-blue-300 leading-relaxed">
{
  <span class="text-purple-400">"table_name"</span>: <span class="text-emerald-400">"customer_messages"</span>,
  <span class="text-purple-400">"columns"</span>: {
    <span class="text-purple-400">"id"</span>: <span class="text-amber-400">"BIGINT (Primary Key, Auto Increment)"</span>,
    <span class="text-purple-400">"nama_lengkap"</span>: <span class="text-amber-400">"VARCHAR(255)"</span>,
    <span class="text-purple-400">"email_bisnis"</span>: <span class="text-amber-400">"VARCHAR(255), Validated Email"</span>,
    <span class="text-purple-400">"nama_toko"</span>: <span class="text-amber-400">"VARCHAR(255), Nullable"</span>,
    <span class="text-purple-400">"no_whatsapp"</span>: <span class="text-amber-400">"VARCHAR(20)"</span>,
    <span class="text-purple-400">"subjek_pesan"</span>: <span class="text-amber-400">"TEXT, Auto Prefixed with [Paket Pilihan]"</span>,
    <span class="text-purple-400">"pesan_konten"</span>: <span class="text-amber-400">"LONGTEXT"</span>,
    <span class="text-purple-400">"created_at"</span>: <span class="text-amber-400">"TIMESTAMP"</span>
  }
}</pre>
                    </div>
                </div>

            </div>

            <div class="space-y-8">
                
                <div class="bg-[#1e293b] p-6 rounded-3xl border border-slate-800 shadow-xl flex flex-col justify-between h-full">
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-orange-500 animate-ping"></span>
                                Live System Logs
                            </h3>
                            <span class="text-xs text-slate-500 code-font">REALTIME</span>
                        </div>
                        
                        <div class="space-y-3 code-font text-xs">
                            <div class="p-3 bg-[#0f172a] rounded-xl border-l-4 border-emerald-500">
                                <p class="text-slate-400">[2026-05-20 17:01:14]</p>
                                <p class="text-white mt-1"><span class="text-emerald-400">SUCCESS:</span> Form Kontak masuk ke DB. Nama: <span class="text-blue-400">Rian Palangka</span></p>
                            </div>
                            <div class="p-3 bg-[#0f172a] rounded-xl border-l-4 border-blue-500">
                                <p class="text-slate-400">[2026-05-20 17:01:16]</p>
                                <p class="text-white mt-1"><span class="text-blue-400">INFO:</span> Auto-Responder terkirim ke <span class="text-amber-400">rian@media.com</span></p>
                            </div>
                            <div class="p-3 bg-[#0f172a] rounded-xl border-l-4 border-amber-500">
                                <p class="text-slate-400">[2026-05-20 16:54:22]</p>
                                <p class="text-white mt-1"><span class="text-amber-400">WARN:</span> Request parameter `?paket=Enterprise` terpencet.</p>
                            </div>
                            <div class="p-3 bg-[#0f172a] rounded-xl border-l-4 border-emerald-500">
                                <p class="text-slate-400">[2026-05-20 16:40:02]</p>
                                <p class="text-white mt-1"><span class="text-emerald-400">SUCCESS:</span> Auth token generated untuk Role Admin Dashboard.</p>
                            </div>
                        </div>
                    </div>

                    <button onclick="alert('Log dibersihkan dari layar!')" class="mt-6 w-full py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl text-xs font-semibold tracking-wider uppercase transition border border-slate-700">
                        Clear Log Console
                    </button>
                </div>

            </div>

        </div>

    </main>

    <footer class="border-t border-slate-800 bg-[#0f172a] py-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs text-slate-500 code-font">
            <p>KasirKu POS Core v2.0-STABLE // PHP 8.2 // Laravel 10.x // Tailwind Engine Integration</p>
        </div>
    </footer>

</body>
</html>