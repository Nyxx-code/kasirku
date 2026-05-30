<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\User; // Import Model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Untuk enkripsi password

class DeveloperController extends Controller
{
    public function index()
    {
        return view('developer.dashboard');
    }

    public function showRegisterForm()
    {
        return view('developer.register-admin');
    }

    public function storeAdmin(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Simpan ke Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => 'admin', // Otomatis set sebagai admin
        ]);

        // 3. Redirect dengan pesan sukses
        return redirect()->route('developer.dashboard')->with('status', 'Akun Admin Baru Berhasil Dibuat!');
    }
}