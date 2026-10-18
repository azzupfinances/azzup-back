<?php

namespace Database\Factories;

use App\Enums\TransactionCategory;
use App\Models\CardPurchase;
use App\Models\CreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CardPurchase>
 */
class CardPurchaseFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'credit_card_id' => CreditCard::factory(),
            'description' => fake()->words(2, true),
            'category' => fake()->randomElement(TransactionCategory::cases()),
            'total_cents' => fake()->numberBetween(1000, 500000),
            'installments_count' => fake()->numberBetween(1, 12),
            'purchase_date' => fake()->dateTimeThisYear()->format('Y-m-d'),
        ];
    }
}
