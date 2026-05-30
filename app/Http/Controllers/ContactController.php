<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function kirimPesan(Request $request)
    {
        // ... proses simpan ke database atau kirim email di sini ...

        // Masukkan return dialog suksesnya di sini:
        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah berhasil kami simpan di sistem. Tim KasirKu akan segera meninjau dan menghubungi Anda kembali.');
    }
}