<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Kopi Sachet',
                'sku' => 'KOPI-001',
                'price' => 10000,
                'stock' => 100,
            ],
            [
                'name' => 'Gula 1kg',
                'sku' => 'GULA-001',
                'price' => 15000,
                'stock' => 50,
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }
    }
}
