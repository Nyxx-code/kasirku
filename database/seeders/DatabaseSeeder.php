<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. HANYA BUAT 1 AKUN DEVELOPER INI SAJA UNTUK DEMO BESOK
        User::query()->create([
            'name' => 'Super Developer',
            'email' => 'dev@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'developer',
            'store_name' => '-',
            'phone_number' => '-',
        ]);

        // 2. KITA MATIKAN SEMUA SEEDER LAIN AGAR DATABASE BERSIH (TIDAK ADA PRODUK/TRANSAKSI HANTU)
        /* $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            SaleSeeder::class,
            SaleItemSeeder::class,
        ]);
        */
    }
}