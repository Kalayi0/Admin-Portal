<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'amount' => fake()->randomFloat(2, 20, 5000),
            'status' => fake()->randomElement(['pending', 'completed', 'failed', 'refunded']),
            'payment_method' => fake()->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'completed_at' => fake()->optional(0.8)->dateTimeThisMonth(),
        ];
    }
}