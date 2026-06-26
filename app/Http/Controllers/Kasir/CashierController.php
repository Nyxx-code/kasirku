<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CashierController extends Controller
{
    public function index()
    {
        // KUNCI 1: Tarik kasir yang store_id-nya adalah ID Admin saat ini (Auth::id())
        $cashiers = User::where('store_id', Auth::id())
                        ->where('role', 'kasir')
                        ->get();

        return view('admin.cashiers.index', compact('cashiers'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // KUNCI 2: Hitung batas maksimal kasir HANYA di toko Admin ini
        $currentCount = User::where('store_id', Auth::id())
                            ->where('role', 'kasir')
                            ->count();

        if ($currentCount >= 2) {
            return back()->withErrors(['error' => 'Maaf, maksimal hanya bisa mendaftarkan 2 kasir.']);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kasir',
            
            // KUNCI 3 (PALING PENTING): 
            // Isi store_id dengan ID Admin, BUKAN Auth::user()->store_id
            'store_id' => Auth::id(), 
        ]);

        return redirect()->back()->with('status', 'Kasir berhasil ditambahkan!');
    }

    public function update(Request $request, $id) 
    {
        // KUNCI 4: Pastikan Admin HANYA BISA mengedit kasir miliknya sendiri
        $kasir = User::where('store_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $kasir->name = $request->name;
        $kasir->email = $request->email;

        if ($request->filled('password')) {
            $kasir->password = Hash::make($request->password);
        }

        $kasir->save();

        return redirect()->back()->with('status', 'Data kasir berhasil diperbarui!');
    }

    public function destroy($id) 
    {
        // KUNCI 5: Pastikan Admin HANYA BISA menghapus kasir miliknya sendiri
        $kasir = User::where('store_id', Auth::id())->findOrFail($id);
        $kasir->delete();

        return redirect()->back()->with('status', 'Kasir berhasil dihapus!');
    }
}