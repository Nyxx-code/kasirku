@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-center items-center p-6" style="min-height: 80vh; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 24px; box-sizing: border-box;">
    
    <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-slate-100" 
         style="width: 100%; max-w: 480px; background-color: #ffffff; padding: 40px; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);">
        
        <div style="text-align: center; margin-bottom: 32px;">
            <h1 class="text-2xl font-bold text-slate-800" style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0;">Registrasi Admin Baru</h1>
            <p class="text-slate-500 text-sm" style="font-size: 14px; color: #64748b; margin: 0;">Silakan isi data untuk mendaftarkan akun bisnis klien baru.</p>
        </div>

        <form action="{{ route('developer.register.admin.submit') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            @csrf
            
            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label style="font-size: 14px; font-weight: 600; color: #334155; text-align: left;">Nama Lengkap Admin</label>
                <input type="text" name="name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none text-slate-800 transition" 
                       style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #cbd5e1; font-size: 15px; color: #1e293b; box-sizing: border-box;" 
                       placeholder="Masukkan nama lengkap admin" required>
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label style="font-size: 14px; font-weight: 600; color: #334155; text-align: left;">Nama Toko / Bisnis</label>
                <input type="text" name="store_name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none text-slate-800 transition" 
                       style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #cbd5e1; font-size: 15px; color: #1e293b; box-sizing: border-box;" 
                       placeholder="Contoh: Gunung Media Computer" required>
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label style="font-size: 14px; font-weight: 600; color: #334155; text-align: left;">Alamat Email</label>
                <input type="email" name="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none text-slate-800 transition" 
                       style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #cbd5e1; font-size: 15px; color: #1e293b; box-sizing: border-box;" 
                       placeholder="contoh@domain.com" required>
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label style="font-size: 14px; font-weight: 600; color: #334155; text-align: left;">Password</label>
                <div style="position: relative; width: 100%;">
                    <input type="password" id="password" name="password" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none text-slate-800 transition" 
                           style="width: 100%; padding: 12px 45px 12px 16px; border-radius: 12px; border: 1px solid #cbd5e1; font-size: 15px; color: #1e293b; box-sizing: border-box;" required>
                    <button type="button" onclick="togglePassword('password', 'eye-icon-1')" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; padding: 0;">
                        <svg id="eye-icon-1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label style="font-size: 14px; font-weight: 600; color: #334155; text-align: left;">Konfirmasi Password</label>
                <div style="position: relative; width: 100%;">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none text-slate-800 transition" 
                           style="width: 100%; padding: 12px 45px 12px 16px; border-radius: 12px; border: 1px solid #cbd5e1; font-size: 15px; color: #1e293b; box-sizing: border-box;" required>
                    <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; padding: 0;">
                        <svg id="eye-icon-2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 16px;">
                <button type="submit" class="w-full py-3 rounded-xl bg-[#1e4e79] text-white font-bold transition text-sm" 
                        style="width: 100%; padding: 14px; border-radius: 12px; background-color: #1e4e79; color: #ffffff; font-weight: 700; font-size: 14px; border: none; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(30, 78, 121, 0.2);">
                    Buat Akun Admin
                </button>
                <a href="/developer/admin" class="w-full text-center py-3 rounded-xl border border-slate-200 text-slate-600 font-bold transition text-sm" 
                   style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #cbd5e1; color: #64748b; font-weight: 700; font-size: 14px; text-align: center; text-decoration: none; box-sizing: border-box;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(iconId);
    
    // Ambil elemen path mata terbuka dan mata tertutup di dalam SVG
    const openPaths = eyeIcon.querySelectorAll('.eye-open');
    const closedPath = eyeIcon.querySelector('.eye-closed');

    if (passwordInput.type === 'password') {
        // Ubah jadi kelihatan teksnya
        passwordInput.type = 'text';
        // Sembunyikan mata terbuka, munculkan mata dicoret
        openPaths.forEach(path => path.classList.add('hidden'));
        closedPath.classList.remove('hidden');
    } else {
        // Ubah jadi tersembunyi kembali
        passwordInput.type = 'password';
        // Munculkan mata terbuka, sembunyikan mata dicoret
        openPaths.forEach(path => path.classList.remove('hidden'));
        closedPath.classList.add('hidden');
    }
}
</script>
@endsection