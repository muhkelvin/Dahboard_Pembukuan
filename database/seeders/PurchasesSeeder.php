<?php

namespace Database\Seeders;

use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Purchase::create(['product_id' => 1, 'name' => 'John Doe', 'quantity' => 2, 'total_price' => 999.98, 'purchase_date' => Carbon::parse('2024-10-01'), 'payment_status' => 'Lunas']);
        Purchase::create(['product_id' => 2, 'name' => 'Jane Smith', 'quantity' => 5, 'total_price' => 99.95, 'purchase_date' => Carbon::parse('2024-10-02'), 'payment_status' => 'Belum Lunas']);
        Purchase::create(['product_id' => 3, 'name' => 'Mike Johnson', 'quantity' => 1, 'total_price' => 14.99, 'purchase_date' => Carbon::parse('2024-10-03'), 'payment_status' => 'Lunas']);
        Purchase::create(['product_id' => 4, 'name' => 'Sarah Williams', 'quantity' => 3, 'total_price' => 2999.97, 'purchase_date' => Carbon::parse('2024-10-04'), 'payment_status' => 'Lunas']);
        Purchase::create(['product_id' => 5, 'name' => 'David Brown', 'quantity' => 4, 'total_price' => 119.96, 'purchase_date' => Carbon::parse('2024-10-05'), 'payment_status' => 'Belum Lunas']);
        Purchase::create(['product_id' => 6, 'name' => 'Emily Davis', 'quantity' => 6, 'total_price' => 59.94, 'purchase_date' => Carbon::parse('2024-10-06'), 'payment_status' => 'Lunas']);
        Purchase::create(['product_id' => 7, 'name' => 'Chris Garcia', 'quantity' => 1, 'total_price' => 299.99, 'purchase_date' => Carbon::parse('2024-10-07'), 'payment_status' => 'Belum Lunas']);
        Purchase::create(['product_id' => 8, 'name' => 'Jessica Lee', 'quantity' => 2, 'total_price' => 99.98, 'purchase_date' => Carbon::parse('2024-10-08'), 'payment_status' => 'Lunas']);
        Purchase::create(['product_id' => 9, 'name' => 'Michael Wilson', 'quantity' => 3, 'total_price' => 59.97, 'purchase_date' => Carbon::parse('2024-10-09'), 'payment_status' => 'Belum Lunas']);
        Purchase::create(['product_id' => 10, 'name' => 'Sophia Martinez', 'quantity' => 4, 'total_price' => 199.96, 'purchase_date' => Carbon::parse('2024-10-10'), 'payment_status' => 'Lunas']);
        // Tambahkan pembelian lain sesuai kebutuhan
    }
}
