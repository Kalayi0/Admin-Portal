<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\ServiceStatus;
use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create products
        Product::factory(100)->create();

        // Create customers (50 unique emails)
        User::factory(50)->create(['role' => 'customer']);

        // Create admin users – use unique emails that won't conflict
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Second Admin',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create transactions
        Transaction::factory(500)->create();

        // Pre-fill service statuses
        $services = ['API Gateway', 'User Service', 'Product Service', 'Order Service', 'Payment Service', 'Inventory DB'];
        foreach ($services as $service) {
            ServiceStatus::create([
                'service_name' => $service,
                'status' => fake()->randomElement(['online', 'warning', 'offline']),
                'response_time_ms' => fake()->numberBetween(45, 800),
                'checked_at' => now(),
            ]);
        }

        // Create recent activities
        Activity::factory(50)->create();
    }
}