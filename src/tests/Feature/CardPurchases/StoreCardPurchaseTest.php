<?php

declare(strict_types=1);

namespace Tests\Feature\CardPurchases;

use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreCardPurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_purchase_on_the_users_card(): void
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->postJson('/api/card-purchases', [
            'credit_card_id' => $creditCard->id,
            'description' => ' Flight ',
            'category' => 'leisure',
            'total_cents' => 128000,
            'installments_count' => 4,
            'purchase_date' => '2026-09-28',
        ])
            ->assertCreated()
            ->assertJsonPath('data.description', 'Flight')
            ->assertJsonPath('data.installments_count', 4)
            ->assertJsonPath('data.purchase_date', '2026-09-28');

        $this->assertDatabaseHas('card_purchases', ['credit_card_id' => $creditCard->id, 'total_cents' => 128000]);
    }

    public function test_rejects_another_users_card(): void
    {
        $creditCard = CreditCard::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/card-purchases', [
            'credit_card_id' => $creditCard->id,
            'description' => 'Flight',
            'category' => 'leisure',
            'total_cents' => 128000,
            'installments_count' => 4,
            'purchase_date' => '2026-09-28',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['credit_card_id']);

        $this->assertDatabaseCount('card_purchases', 0);
    }

    public function test_rejects_invalid_values(): void
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->postJson('/api/card-purchases', [
            'credit_card_id' => $creditCard->id,
            'description' => '',
            'category' => 'transport',
            'total_cents' => 0,
            'installments_count' => 25,
            'purchase_date' => '2026-02-30',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['description', 'category', 'total_cents', 'installments_count', 'purchase_date']);
    }

    public function test_requires_authentication(): void
    {
        $this->postJson('/api/card-purchases', [])->assertUnauthorized();
    }
}
