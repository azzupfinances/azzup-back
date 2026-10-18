<?php

declare(strict_types=1);

namespace Tests\Feature\Receivables;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreReceivableTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_the_receivable(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->postJson('/api/receivables', [
            'description' => ' Bike sale ',
            'payer_name' => ' Lucas ',
            'total_cents' => 60000,
            'installments_count' => 3,
            'first_due_date' => '2026-09-05',
        ])
            ->assertCreated()
            ->assertJsonPath('data.description', 'Bike sale')
            ->assertJsonPath('data.payer_name', 'Lucas')
            ->assertJsonPath('data.total_cents', 60000)
            ->assertJsonPath('data.installments_count', 3)
            ->assertJsonPath('data.first_due_date', '2026-09-05')
            ->assertJsonPath('data.received_months', []);

        $this->assertDatabaseHas('receivables', ['user_id' => $user->id]);
    }

    public function test_rejects_invalid_values(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/receivables', [
            'description' => '',
            'payer_name' => '',
            'total_cents' => 0,
            'installments_count' => 25,
            'first_due_date' => '2026-02-30',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['description', 'payer_name', 'total_cents', 'installments_count', 'first_due_date']);
    }

    public function test_requires_authentication(): void
    {
        $this->postJson('/api/receivables', [])->assertUnauthorized();
    }
}
