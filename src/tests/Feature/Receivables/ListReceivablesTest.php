<?php

declare(strict_types=1);

namespace Tests\Feature\Receivables;

use App\Models\Receivable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ListReceivablesTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_the_users_receivables_with_their_months(): void
    {
        $user = User::factory()->create();
        $record = Receivable::factory()->for($user)->create([
            'description' => 'Loan',
            'payer_name' => 'Pedro',
            'total_cents' => 100000,
            'installments_count' => 10,
            'first_due_date' => '2026-06-15',
        ]);
        $record->receipts()->createMany([['month' => '2026-10'], ['month' => '2026-09']]);
        Receivable::factory()->create();
        Sanctum::actingAs($user);

        $this->getJson('/api/receivables')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.description', 'Loan')
            ->assertJsonPath('data.0.payer_name', 'Pedro')
            ->assertJsonPath('data.0.total_cents', 100000)
            ->assertJsonPath('data.0.installments_count', 10)
            ->assertJsonPath('data.0.first_due_date', '2026-06-15')
            ->assertJsonPath('data.0.received_months', ['2026-09', '2026-10'])
            ->assertJsonMissingPath('data.0.user_id')
            ->assertJsonMissingPath('data.0.receipts');
    }

    public function test_requires_authentication(): void
    {
        $this->getJson('/api/receivables')->assertUnauthorized();
    }
}
