<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kasir = User::where('email', 'kasir@example.com')->first();

        Sale::firstOrCreate(
            [
                'user_id' => $kasir->id,
                'sold_at' => Carbon::today(),
            ],
            [
                'total' => 35000,
                'paid' => 50000,
                'change' => 15000,
            ]
        );
    }
}
