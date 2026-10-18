<?php

declare(strict_types=1);

namespace Tests\Feature\CreditCards;

use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ListCreditCardsTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_the_users_cards_with_paid_invoice_months(): void
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->for($user)->create([
            'name' => 'Nubank',
            'bank' => 'nubank',
            'limit_cents' => 800000,
            'due_day' => 10,
        ]);
        $creditCard->invoicePayments()->createMany([['month' => '2026-10'], ['month' => '2026-09']]);
        CreditCard::factory()->create();
        Sanctum::actingAs($user);

        $this->getJson('/api/credit-cards')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Nubank')
            ->assertJsonPath('data.0.bank', 'nubank')
            ->assertJsonPath('data.0.limit_cents', 800000)
            ->assertJsonPath('data.0.due_day', 10)
            ->assertJsonPath('data.0.paid_invoice_months', ['2026-09', '2026-10'])
            ->assertJsonMissingPath('data.0.user_id')
            ->assertJsonMissingPath('data.0.invoice_payments');
    }

    public function test_requires_authentication(): void
    {
        $this->getJson('/api/credit-cards')->assertUnauthorized();
    }
}
