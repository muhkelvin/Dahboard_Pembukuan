<?php

namespace Database\Seeders;

use App\Models\Revenue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RevenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Revenue::create(['purchase_id' => 1]);
        Revenue::create(['purchase_id' => 2]);
        Revenue::create(['purchase_id' => 3]);
        Revenue::create(['purchase_id' => 4]);
        Revenue::create(['purchase_id' => 5]);
        Revenue::create(['purchase_id' => 6]);
        Revenue::create(['purchase_id' => 7]);
        Revenue::create(['purchase_id' => 8]);
        Revenue::create(['purchase_id' => 9]);
        Revenue::create(['purchase_id' => 10]);
    }
}
