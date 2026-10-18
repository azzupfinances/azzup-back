<?php

declare(strict_types=1);

namespace Tests\Feature\Bills;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ListBillsTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_the_users_bills_with_their_months(): void
    {
        $user = User::factory()->create();
        $record = Bill::factory()->for($user)->create(['name' => 'Rent', 'category' => 'housing', 'amount_cents' => 120000, 'due_day' => 10]);
        $record->payments()->createMany([['month' => '2026-10'], ['month' => '2026-09']]);
        Bill::factory()->create();
        Sanctum::actingAs($user);

        $this->getJson('/api/bills')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Rent')
            ->assertJsonPath('data.0.category', 'housing')
            ->assertJsonPath('data.0.amount_cents', 120000)
            ->assertJsonPath('data.0.due_day', 10)
            ->assertJsonPath('data.0.paid_months', ['2026-09', '2026-10'])
            ->assertJsonMissingPath('data.0.user_id')
            ->assertJsonMissingPath('data.0.payments');
    }

    public function test_requires_authentication(): void
    {
        $this->getJson('/api/bills')->assertUnauthorized();
    }
}
