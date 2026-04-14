<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word() . ' ' . fake()->randomNumber(4), 
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 999),
            'stock_quantity' => fake()->numberBetween(0, 500),
            'sku' => strtoupper(fake()->unique()->bothify('SKU-####??')), 
            'is_active' => true,
        ];
    }
}