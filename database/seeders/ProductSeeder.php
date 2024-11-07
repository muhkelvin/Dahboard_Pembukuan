<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
    {
        Product::create(['category_id' => 1, 'name' => 'Smartphone', 'description' => 'Latest model with high performance', 'price' => 499.99, 'stock' => 100]);
        Product::create(['category_id' => 2, 'name' => 'T-shirt', 'description' => 'Comfortable cotton T-shirt', 'price' => 19.99, 'stock' => 250]);
        Product::create(['category_id' => 3, 'name' => 'Novel', 'description' => 'Bestselling novel of the year', 'price' => 14.99, 'stock' => 150]);
        Product::create(['category_id' => 1, 'name' => 'Laptop', 'description' => 'Lightweight and powerful laptop', 'price' => 999.99, 'stock' => 50]);
        Product::create(['category_id' => 2, 'name' => 'Jeans', 'description' => 'Stylish denim jeans', 'price' => 29.99, 'stock' => 100]);
        Product::create(['category_id' => 3, 'name' => 'Comic Book', 'description' => 'Popular comic series', 'price' => 9.99, 'stock' => 300]);
        Product::create(['category_id' => 1, 'name' => 'Tablet', 'description' => 'Portable and high-resolution display', 'price' => 299.99, 'stock' => 75]);
        Product::create(['category_id' => 2, 'name' => 'Jacket', 'description' => 'Warm and comfortable jacket', 'price' => 49.99, 'stock' => 120]);
        Product::create(['category_id' => 3, 'name' => 'Cookbook', 'description' => 'Recipe book for home cooking', 'price' => 19.99, 'stock' => 80]);
        Product::create(['category_id' => 1, 'name' => 'Headphones', 'description' => 'Noise-cancelling headphones', 'price' => 149.99, 'stock' => 200]);
        Product::create(['category_id' => 2, 'name' => 'Sneakers', 'description' => 'Comfortable sports sneakers', 'price' => 59.99, 'stock' => 180]);
        Product::create(['category_id' => 3, 'name' => 'Biography', 'description' => 'Inspiring life story', 'price' => 24.99, 'stock' => 70]);
        Product::create(['category_id' => 1, 'name' => 'Smartwatch', 'description' => 'Track your health and fitness', 'price' => 199.99, 'stock' => 130]);
        Product::create(['category_id' => 2, 'name' => 'Scarf', 'description' => 'Stylish winter scarf', 'price' => 15.99, 'stock' => 220]);
        Product::create(['category_id' => 3, 'name' => 'History Book', 'description' => 'Learn about world history', 'price' => 29.99, 'stock' => 40]);
        Product::create(['category_id' => 1, 'name' => 'Camera', 'description' => 'Capture high-quality photos', 'price' => 699.99, 'stock' => 60]);
        Product::create(['category_id' => 2, 'name' => 'Hat', 'description' => 'Casual and comfortable hat', 'price' => 14.99, 'stock' => 200]);
        Product::create(['category_id' => 3, 'name' => 'Science Book', 'description' => 'Explore the world of science', 'price' => 34.99, 'stock' => 50]);
        Product::create(['category_id' => 1, 'name' => 'Bluetooth Speaker', 'description' => 'Portable speaker with great sound', 'price' => 89.99, 'stock' => 90]);
        Product::create(['category_id' => 2, 'name' => 'Socks', 'description' => 'Warm and cozy socks', 'price' => 5.99, 'stock' => 300]);
        Product::create(['category_id' => 3, 'name' => 'Adventure Book', 'description' => 'Thrilling adventure story', 'price' => 12.99, 'stock' => 110]);
        Product::create(['category_id' => 1, 'name' => 'Monitor', 'description' => 'High-definition display', 'price' => 249.99, 'stock' => 40]);
        Product::create(['category_id' => 2, 'name' => 'Gloves', 'description' => 'Warm gloves for winter', 'price' => 10.99, 'stock' => 150]);
        Product::create(['category_id' => 3, 'name' => 'Math Workbook', 'description' => 'Practice math skills', 'price' => 17.99, 'stock' => 60]);
        Product::create(['category_id' => 1, 'name' => 'Keyboard', 'description' => 'Mechanical keyboard', 'price' => 59.99, 'stock' => 70]);
        Product::create(['category_id' => 2, 'name' => 'Pants', 'description' => 'Comfortable cotton pants', 'price' => 39.99, 'stock' => 130]);
        Product::create(['category_id' => 3, 'name' => 'Thriller Book', 'description' => 'Suspenseful thriller novel', 'price' => 21.99, 'stock' => 90]);
        Product::create(['category_id' => 1, 'name' => 'Mouse', 'description' => 'Wireless mouse', 'price' => 29.99, 'stock' => 110]);
        Product::create(['category_id' => 2, 'name' => 'Sweater', 'description' => 'Warm winter sweater', 'price' => 45.99, 'stock' => 100]);
        Product::create(['category_id' => 3, 'name' => 'Fantasy Book', 'description' => 'Fantasy world adventure', 'price' => 18.99, 'stock' => 70]);
        Product::create(['category_id' => 1, 'name' => 'Charger', 'description' => 'Fast charging adapter', 'price' => 24.99, 'stock' => 140]);
        Product::create(['category_id' => 2, 'name' => 'Belt', 'description' => 'Leather belt', 'price' => 19.99, 'stock' => 160]);
        Product::create(['category_id' => 3, 'name' => 'Poetry Book', 'description' => 'Collection of poems', 'price' => 15.99, 'stock' => 50]);
        Product::create(['category_id' => 1, 'name' => 'Hard Drive', 'description' => 'Portable hard drive', 'price' => 89.99, 'stock' => 80]);
        Product::create(['category_id' => 2, 'name' => 'Sunglasses', 'description' => 'Stylish sunglasses', 'price' => 25.99, 'stock' => 90]);
        Product::create(['category_id' => 3, 'name' => 'Horror Book', 'description' => 'Scary horror novel', 'price' => 16.99, 'stock' => 75]);
        Product::create(['category_id' => 1, 'name' => 'Printer', 'description' => 'High-quality printer', 'price' => 129.99, 'stock' => 60]);
        Product::create(['category_id' => 2, 'name' => 'Boots', 'description' => 'Durable winter boots', 'price' => 79.99, 'stock' => 80]);
        Product::create(['category_id' => 3, 'name' => 'Romance Book', 'description' => 'Love story', 'price' => 11.99, 'stock' => 130]);
        Product::create(['category_id' => 1, 'name' => 'Flash Drive', 'description' => 'USB flash drive', 'price' => 9.99, 'stock' => 250]);
        Product::create(['category_id' => 2, 'name' => 'Watch', 'description' => 'Elegant wristwatch', 'price' => 49.99, 'stock' => 75]);
        Product::create(['category_id' => 3, 'name' => 'Self-help Book', 'description' => 'Guide to self-improvement', 'price' => 22.99, 'stock' => 85]);
        Product::create(['category_id' => 1, 'name' => 'Drone', 'description' => 'Compact aerial drone', 'price' => 399.99, 'stock' => 30]);
        Product::create(['category_id' => 2, 'name' => 'Backpack', 'description' => 'Spacious and durable backpack', 'price' => 39.99, 'stock' => 120]);
        Product::create(['category_id' => 3, 'name' => 'Mystery Book', 'description' => 'Intriguing mystery story', 'price' => 13.99, 'stock' => 95]);
        Product::create(['category_id' => 1, 'name' => 'Router', 'description' => 'High-speed wireless router', 'price' => 89.99, 'stock' => 70]);
        Product::create(['category_id' => 2, 'name' => 'Shoes', 'description' => 'Comfortable casual shoes', 'price' => 49.99, 'stock' => 90]);
        Product::create(['category_id' => 3, 'name' => 'Cooking Guide', 'description' => 'Guide to cooking basics', 'price' => 20.99, 'stock' => 100]);
        Product::create(['category_id' => 1, 'name' => 'Projector', 'description' => 'Portable mini projector', 'price' => 199.99, 'stock' => 40]);
        Product::create(['category_id' => 2, 'name' => 'Blazer', 'description' => 'Professional blazer', 'price' => 79.99, 'stock' => 70]);
        Product::create(['category_id' => 3, 'name' => 'Graphic Novel', 'description' => 'Illustrated graphic novel', 'price' => 14.99, 'stock' => 90]);
        Product::create(['category_id' => 1, 'name' => 'Game Console', 'description' => 'Popular gaming console', 'price' => 299.99, 'stock' => 50]);
        Product::create(['category_id' => 2, 'name' => 'Vest', 'description' => 'Warm and stylish vest', 'price' => 29.99, 'stock' => 150]);
        Product::create(['category_id' => 3, 'name' => 'Educational Book', 'description' => 'Guide to various subjects', 'price' => 25.99, 'stock' => 80]);
    }
}
