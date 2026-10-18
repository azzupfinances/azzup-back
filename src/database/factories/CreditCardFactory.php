<?php

namespace Database\Factories;

use App\Enums\Bank;
use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CreditCard>
 */
class CreditCardFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'bank' => fake()->randomElement(Bank::cases()),
            'limit_cents' => fake()->numberBetween(50000, 2000000),
            'due_day' => fake()->numberBetween(1, 31),
        ];
    }
}
