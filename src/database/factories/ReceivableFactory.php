<?php

namespace Database\Factories;

use App\Models\Receivable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Receivable>
 */
class ReceivableFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'description' => fake()->words(2, true),
            'payer_name' => fake()->firstName(),
            'total_cents' => fake()->numberBetween(1000, 500000),
            'installments_count' => fake()->numberBetween(1, 12),
            'first_due_date' => fake()->dateTimeThisYear()->format('Y-m-d'),
        ];
    }
}
