<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ListTransactionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_the_month_newest_first(): void
    {
        $user = User::factory()->create();
        $older = Transaction::factory()->for($user)->create(['transaction_date' => '2026-10-01']);
        $firstOfDay = Transaction::factory()->for($user)->create(['transaction_date' => '2026-10-31']);
        $secondOfDay = Transaction::factory()->for($user)->create(['transaction_date' => '2026-10-31']);
        Transaction::factory()->for($user)->create(['transaction_date' => '2026-09-30']);
        Transaction::factory()->for($user)->create(['transaction_date' => '2026-11-01']);
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/transactions?month=2026-10')->assertOk();

        $this->assertSame(
            [$secondOfDay->id, $firstOfDay->id, $older->id],
            array_column($response->json('data'), 'id'),
        );
        $response->assertJsonPath('data.2.transaction_date', '2026-10-01');
    }

    public function test_returns_the_transaction_fields(): void
    {
        $user = User::factory()->create();
        Transaction::factory()->for($user)->create([
            'description' => 'Groceries',
            'amount_cents' => -18432,
            'transaction_date' => '2026-10-07',
            'category' => 'food',
            'payment_method' => 'debit_card',
        ]);
        Sanctum::actingAs($user);

        $this->getJson('/api/transactions?month=2026-10')
            ->assertOk()
            ->assertJsonPath('data.0.description', 'Groceries')
            ->assertJsonPath('data.0.amount_cents', -18432)
            ->assertJsonPath('data.0.category', 'food')
            ->assertJsonPath('data.0.origin', 'manual')
            ->assertJsonPath('data.0.payment_method', 'debit_card')
            ->assertJsonMissingPath('data.0.user_id');
    }

    public function test_lists_only_the_users_own_transactions(): void
    {
        Transaction::factory()->create(['transaction_date' => '2026-10-07']);
        Sanctum::actingAs(User::factory()->create());

        $this->getJson('/api/transactions?month=2026-10')
            ->assertOk()
            ->assertJsonCount(0, 'data');
    }

    public function test_requires_a_valid_month(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->getJson('/api/transactions')->assertUnprocessable()->assertJsonValidationErrors(['month']);
        $this->getJson('/api/transactions?month=2026-13')->assertUnprocessable()->assertJsonValidationErrors(['month']);
    }

    public function test_requires_authentication(): void
    {
        $this->getJson('/api/transactions?month=2026-10')->assertUnauthorized();
    }
}
