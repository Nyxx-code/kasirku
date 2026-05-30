<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     * Jika user sudah login, langsung diarahkan ke dashboard sesuai role.
     */
    public function show(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.login');
    }

    /**
     * Memproses logika login.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // 1. Validasi input email dan password
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Cek apakah kredensial cocok di database
        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->withInput();
        }

        // 3. Regenerasi session untuk keamanan (mencegah session fixation)
        $request->session()->regenerate();

        // 4. Arahkan user ke dashboard sesuai role mereka
        return $this->redirectByRole();
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Fungsi menentukan arah redirect berdasarkan role user (Case-Insensitive).
     */
    private function redirectByRole(): RedirectResponse
    {
        $user = Auth::user();

        if ($user) {
            // Ubah role menjadi huruf kecil semua sebelum dicek
            $role = strtolower($user->role);

            // Arahkan Developer ke dashboard khusus dev
            if ($role === 'developer') {
                return redirect()->route('developer.dashboard');
            }

            // Arahkan Admin ke dashboard admin
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }

        // Arahkan Kasir atau role lainnya ke dashboard kasir
        return redirect()->route('kasir.dashboard');
    }
}