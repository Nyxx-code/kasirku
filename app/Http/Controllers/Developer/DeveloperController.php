<?php

namespace App\Http\Controllers\Developer;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeveloperController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('developer.dashboard', compact('admins'));
    }

    public function exportPdf()
    {
        // Ambil data admin
        $admins = \App\Models\User::whereIn('role', ['admin', 'Admin'])->latest()->get();
        $totalAdmin = $admins->count();
        $totalOmzet = $totalAdmin * 350000;
        
        // Load tampilan khusus untuk PDF
        $pdf = Pdf::loadView('developer.transactions.pdf', compact('admins', 'totalAdmin', 'totalOmzet'));
        
        return $pdf->download('Laporan_Sistem_KasirKu_' . date('Y-m-d') . '.pdf');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'store_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'store_name' => $request->store_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('developer.dashboard')->with('status', 'Akun Klien Baru Berhasil Dibuat!');
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'store_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'required|string|max:20',
        ]);

        $admin->update([
            'name' => $request->name,
            'store_name' => $request->store_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $admin->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('developer.dashboard')->with('status', 'Data Klien Berhasil Diperbarui!');
    }

    // FUNGSI TRANSAKSI DENGAN FILTER TANGGAL
    public function transactions(Request $request)
    {
        $query = \App\Models\User::whereIn('role', ['admin', 'Admin']);

        // Logika Filter Rentang Tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00', 
                $request->end_date . ' 23:59:59'
            ]);
        }

        // 1. Ambil data admin beserta jumlah totalnya sesuai filter
        $admins = $query->latest()->get();
        $totalAdmin = $admins->count();

        // 2. Hitung total transaksi (jumlah struk) dan total omzet (jumlah uang) 
        // Mengambil dari seluruh riwayat tabel Sale
        $totalTransaksi = \App\Models\Sale::count();
        $totalOmzet = \App\Models\Sale::sum('total');

        // 3. Kirim semua variabel tersebut ke halaman View
        return view('developer.transactions.index', compact('admins', 'totalAdmin', 'totalTransaksi', 'totalOmzet'));
    }

    // FUNGSI BARU UNTUK MENGHAPUS DATA SECARA PERMANEN (BUMI HANGUS)
    public function destroyAdmin($id)
    {
        $admin = User::findOrFail($id);

        // 1. Kumpulkan semua ID User yang terlibat (ID Admin itu sendiri + ID Kasir-kasirnya)
        $userIds = User::where('store_id', $admin->id)->pluck('id')->toArray();
        $userIds[] = $admin->id;

        // 2. Hapus semua riwayat transaksi penjualan dari toko ini
        $sales = \App\Models\Sale::whereIn('user_id', $userIds)->get();
        foreach ($sales as $sale) {
            \App\Models\SaleItem::where('sale_id', $sale->id)->delete(); // Hapus rincian barang di nota
            $sale->delete(); // Hapus nota
        }

        // 3. Hapus semua Produk yang didaftarkan oleh toko ini
        \App\Models\Product::where('store_id', $admin->id)->delete();

        // 4. Hapus semua akun Kasir milik toko ini
        User::where('store_id', $admin->id)->delete();

        // 5. Terakhir, hapus akun Adminnya
        $admin->delete();

        return redirect()->route('developer.dashboard')->with('status', 'Akun Klien beserta seluruh kasir, produk, dan transaksinya berhasil dihapus permanen!');
    }
}