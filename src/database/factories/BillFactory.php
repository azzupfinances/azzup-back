<?php

namespace Database\Factories;

use App\Enums\TransactionCategory;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bill>
 */
class BillFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->words(2, true),
            'category' => fake()->randomElement(TransactionCategory::cases()),
            'amount_cents' => fake()->numberBetween(1000, 200000),
            'due_day' => fake()->numberBetween(1, 31),
        ];
    }
}
