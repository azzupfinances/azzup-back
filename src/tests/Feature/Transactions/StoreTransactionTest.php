<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_manual_expense(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->postJson('/api/transactions', [
            'description' => ' Groceries ',
            'amount_cents' => -18432,
            'transaction_date' => '2026-10-07',
            'category' => 'food',
            'payment_method' => 'pix',
        ])
            ->assertCreated()
            ->assertJsonPath('data.description', 'Groceries')
            ->assertJsonPath('data.amount_cents', -18432)
            ->assertJsonPath('data.transaction_date', '2026-10-07')
            ->assertJsonPath('data.origin', 'manual')
            ->assertJsonPath('data.payment_method', 'pix');

        $this->assertDatabaseHas('transactions', ['user_id' => $user->id, 'description' => 'Groceries']);
    }

    public function test_creates_income_without_payment_method(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/transactions', [
            'description' => 'Salary',
            'amount_cents' => 485000,
            'transaction_date' => '2026-10-05',
            'category' => 'other',
        ])
            ->assertCreated()
            ->assertJsonPath('data.payment_method', null);
    }

    public function test_ignores_a_client_provided_origin(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/transactions', [
            'description' => 'Salary',
            'amount_cents' => 485000,
            'transaction_date' => '2026-10-05',
            'category' => 'other',
            'origin' => 'imported',
        ])
            ->assertCreated()
            ->assertJsonPath('data.origin', 'manual');
    }

    public function test_requires_a_payment_method_for_expenses(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/transactions', [
            'description' => 'Groceries',
            'amount_cents' => -1000,
            'transaction_date' => '2026-10-07',
            'category' => 'food',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['payment_method']);
    }

    public function test_rejects_a_payment_method_for_income(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/transactions', [
            'description' => 'Salary',
            'amount_cents' => 1000,
            'transaction_date' => '2026-10-07',
            'category' => 'other',
            'payment_method' => 'pix',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['payment_method']);
    }

    public function test_rejects_invalid_values(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/transactions', [
            'description' => '',
            'amount_cents' => 0,
            'transaction_date' => '07/10/2026',
            'category' => 'transport',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['description', 'amount_cents', 'transaction_date', 'category']);
    }

    public function test_rejects_a_credit_card_payment(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/transactions', [
            'description' => 'Groceries',
            'amount_cents' => -1000,
            'transaction_date' => '2026-10-07',
            'category' => 'food',
            'payment_method' => 'credit_card',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['payment_method']);
    }

    public function test_requires_authentication(): void
    {
        $this->postJson('/api/transactions', [])->assertUnauthorized();
    }
}
