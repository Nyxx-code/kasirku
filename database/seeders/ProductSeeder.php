<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User; // WAJIB DITAMBAHKAN untuk memanggil data Admin
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Cari admin pertama yang ada di database untuk dijadikan "Pemilik" produk awal ini
        $admin = User::where('role', 'admin')->first();

        // Jika belum ada admin di database, hentikan seeder produk agar tidak jadi "data hantu"
        if (!$admin) {
            return;
        }

        $products = [
            [
                'name' => 'Kopi Sachet',
                'sku' => 'KOPI-001',
                'price' => 10000,
                'stock' => 100,
                'store_id' => $admin->id, // <--- KUNCI: Tempelkan ke ID Admin
            ],
            [
                'name' => 'Gula 1kg',
                'sku' => 'GULA-001',
                'price' => 15000,
                'stock' => 50,
                'store_id' => $admin->id, // <--- KUNCI: Tempelkan ke ID Admin
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                // Cek ketersediaan berdasarkan SKU di toko admin tersebut saja
                [
                    'sku' => $product['sku'],
                    'store_id' => $admin->id
                ],
                $product
            );
        }
    }
}