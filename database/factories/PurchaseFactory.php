<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => rand(1,111),
            'name' => $this->faker->name(),  // Nama pembeli jika belum lunas
            'quantity' => $this->faker->numberBetween(1, 10),
            'total_price' => $this->faker->randomFloat(2, 10, 1000),
            'purchase_date' => $this->faker->date(),
            'payment_status' => $this->faker->randomElement(['Lunas', 'Belum Lunas']),
        ];
    }
}
