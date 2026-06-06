<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeveloperController extends Controller
{
    public function index()
    {
        return view('developer.dashboard');
    }

    public function manageAdmin()
    {
        // Mengambil data admin dan dikirim ke view
        $admins = User::where('role', 'admin')->get();
        return view('developer.admin.index', compact('admins')); 
    }

    public function showRegisterForm()
    {
        return view('developer.admin.register-admin');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'store_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'store_name' => $request->store_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('developer.admin.index')->with('status', 'Akun Admin Baru Berhasil Dibuat!');
    }
}