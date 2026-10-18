<?php

declare(strict_types=1);

namespace Tests\Feature\CardPurchases;

use App\Models\CardPurchase;
use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ListCardPurchasesTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_the_purchases_of_every_user_card(): void
    {
        $user = User::factory()->create();
        $nubank = CreditCard::factory()->for($user)->create();
        $inter = CreditCard::factory()->for($user)->create();
        CardPurchase::factory()->for($nubank)->create([
            'description' => 'Fridge',
            'category' => 'housing',
            'total_cents' => 359900,
            'installments_count' => 10,
            'purchase_date' => '2026-06-15',
        ]);
        CardPurchase::factory()->for($inter)->create(['purchase_date' => '2026-10-02']);
        CardPurchase::factory()->create();
        Sanctum::actingAs($user);

        $this->getJson('/api/card-purchases')
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('data.0.credit_card_id', $inter->id)
            ->assertJsonPath('data.1.credit_card_id', $nubank->id)
            ->assertJsonPath('data.1.description', 'Fridge')
            ->assertJsonPath('data.1.category', 'housing')
            ->assertJsonPath('data.1.total_cents', 359900)
            ->assertJsonPath('data.1.installments_count', 10)
            ->assertJsonPath('data.1.purchase_date', '2026-06-15')
            ->assertJsonMissingPath('data.0.laravel_through_key');
    }

    public function test_requires_authentication(): void
    {
        $this->getJson('/api/card-purchases')->assertUnauthorized();
    }
}
