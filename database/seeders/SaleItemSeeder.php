<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Database\Seeder;

class SaleItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sale = Sale::first();

        $items = [
            ['sku' => 'KOPI-001', 'qty' => 2],
            ['sku' => 'GULA-001', 'qty' => 1],
        ];

        foreach ($items as $item) {
            $product = Product::where('sku', $item['sku'])->first();

            $subtotal = $product->price * $item['qty'];

            SaleItem::firstOrCreate(
                [
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                ],
                [
                    'qty' => $item['qty'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]
            );
        }
    }
}
