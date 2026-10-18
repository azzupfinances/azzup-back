<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateTransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, mixed>
     */
    private function expensePayload(): array
    {
        return [
            'description' => 'Pharmacy',
            'amount_cents' => -4780,
            'transaction_date' => '2026-10-06',
            'category' => 'health',
            'payment_method' => 'cash',
        ];
    }

    public function test_updates_the_transaction(): void
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/transactions/{$transaction->id}", $this->expensePayload())
            ->assertOk()
            ->assertJsonPath('data.description', 'Pharmacy')
            ->assertJsonPath('data.amount_cents', -4780)
            ->assertJsonPath('data.transaction_date', '2026-10-06')
            ->assertJsonPath('data.category', 'health')
            ->assertJsonPath('data.payment_method', 'cash');
    }

    public function test_turning_an_expense_into_income_clears_the_payment_method(): void
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->for($user)->create(['payment_method' => 'pix']);
        Sanctum::actingAs($user);

        $this->putJson("/api/transactions/{$transaction->id}", [
            'description' => 'Refund',
            'amount_cents' => 4780,
            'transaction_date' => '2026-10-06',
            'category' => 'other',
        ])
            ->assertOk()
            ->assertJsonPath('data.payment_method', null);
    }

    public function test_keeps_the_origin(): void
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->for($user)->create(['origin' => 'imported']);
        Sanctum::actingAs($user);

        $this->putJson("/api/transactions/{$transaction->id}", [...$this->expensePayload(), 'origin' => 'manual'])
            ->assertOk()
            ->assertJsonPath('data.origin', 'imported');
    }

    public function test_rejects_invalid_values(): void
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/transactions/{$transaction->id}", [...$this->expensePayload(), 'amount_cents' => 0])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['amount_cents']);
    }

    public function test_forbids_another_users_transaction(): void
    {
        $transaction = Transaction::factory()->create(['description' => 'Original']);
        Sanctum::actingAs(User::factory()->create());

        $this->putJson("/api/transactions/{$transaction->id}", $this->expensePayload())->assertForbidden();

        $this->assertSame('Original', $transaction->fresh()->description);
    }

    public function test_returns_not_found_for_a_missing_transaction(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->putJson('/api/transactions/999', $this->expensePayload())->assertNotFound();
    }

    public function test_requires_authentication(): void
    {
        $transaction = Transaction::factory()->create();

        $this->putJson("/api/transactions/{$transaction->id}", $this->expensePayload())->assertUnauthorized();
    }
}
