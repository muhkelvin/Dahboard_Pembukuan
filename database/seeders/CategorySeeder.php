<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Electronics', 'description' => 'Electronic devices']);
        Category::create(['name' => 'Clothing', 'description' => 'Apparel and fashion']);
        Category::create(['name' => 'Books', 'description' => 'Various genres of books']);
        // Tambahkan kategori lain jika perlu
    }
}
