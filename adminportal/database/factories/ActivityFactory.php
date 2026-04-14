<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        $types = ['transaction', 'inventory', 'user', 'system', 'alert'];
        $type = fake()->randomElement($types);
        $status = fake()->randomElement(['success', 'warning', 'error']);

        $messages = [
            'transaction' => 'Payment processed for Order #' . fake()->numberBetween(1000, 9999),
            'inventory' => 'Low stock alert: ' . fake()->word() . ' (' . fake()->numberBetween(1, 10) . ' remaining)',
            'user' => 'New ' . fake()->randomElement(['customer', 'enterprise']) . ' registered',
            'system' => 'Database backup completed successfully',
            'alert' => fake()->randomElement(['API Gateway response time elevated', 'High error rate detected', 'Disk usage above 90%']),
        ];

        return [
            'type' => $type,
            'message' => $messages[$type],
            'status' => $status,
            'metadata' => null,
        ];
    }
}