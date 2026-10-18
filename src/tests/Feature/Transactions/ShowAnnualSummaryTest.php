<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShowAnnualSummaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_sums_the_year_per_month_and_category(): void
    {
        $user = User::factory()->create();
        Transaction::factory()->for($user)->income()->create(['amount_cents' => 485000, 'transaction_date' => '2026-01-05']);
        Transaction::factory()->for($user)->create(['amount_cents' => -120000, 'transaction_date' => '2026-01-10', 'category' => 'housing']);
        Transaction::factory()->for($user)->create(['amount_cents' => -18000, 'transaction_date' => '2026-03-31', 'category' => 'food']);
        Transaction::factory()->for($user)->create(['amount_cents' => -2000, 'transaction_date' => '2026-03-01', 'category' => 'food']);
        Transaction::factory()->for($user)->create(['amount_cents' => -99999, 'transaction_date' => '2025-12-31']);
        Transaction::factory()->create(['amount_cents' => -99999, 'transaction_date' => '2026-01-10']);
        Sanctum::actingAs($user);

        $this->getJson('/api/transactions/annual-summary?year=2026')
            ->assertOk()
            ->assertJsonCount(12, 'data.months')
            ->assertJsonPath('data.months.0', ['month' => '2026-01', 'income_cents' => 485000, 'expenses_cents' => 120000])
            ->assertJsonPath('data.months.1', ['month' => '2026-02', 'income_cents' => 0, 'expenses_cents' => 0])
            ->assertJsonPath('data.months.2', ['month' => '2026-03', 'income_cents' => 0, 'expenses_cents' => 20000])
            ->assertJsonPath('data.categories', [
                ['category' => 'housing', 'expenses_cents' => 120000],
                ['category' => 'food', 'expenses_cents' => 20000],
            ]);
    }

    public function test_requires_a_valid_year(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->getJson('/api/transactions/annual-summary')->assertUnprocessable()->assertJsonValidationErrors(['year']);
        $this->getJson('/api/transactions/annual-summary?year=26')->assertUnprocessable()->assertJsonValidationErrors(['year']);
    }

    public function test_requires_authentication(): void
    {
        $this->getJson('/api/transactions/annual-summary?year=2026')->assertUnauthorized();
    }
}
