<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Laptop Dell',
                'iPhone 13',
                'Tai nghe Bluetooth',
                'Chuột Logitech',
                'Bàn phím cơ'
            ]),
            'price' => fake()->numberBetween(500000, 20000000),
            'quantity' => fake()->numberBetween(0, 20),
            'category' => fake()->randomElement([
                'Điện tử',
                'Công nghệ',
                'Phụ kiện',
                'Gia dụng'
            ]),
        ];
    }
}
