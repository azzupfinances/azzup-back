<?php

namespace Database\Factories;

use App\Enums\PaymentMethod;
use App\Enums\TransactionCategory;
use App\Enums\TransactionOrigin;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Defaults to a manual expense.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'description' => fake()->words(2, true),
            'amount_cents' => -fake()->numberBetween(100, 50000),
            'transaction_date' => fake()->dateTimeThisYear()->format('Y-m-d'),
            'category' => fake()->randomElement(TransactionCategory::cases()),
            'origin' => TransactionOrigin::Manual,
            'payment_method' => fake()->randomElement(PaymentMethod::cases()),
        ];
    }

    public function income(): static
    {
        return $this->state(fn (array $attributes) => [
            'amount_cents' => fake()->numberBetween(100, 500000),
            'payment_method' => null,
        ]);
    }
}
