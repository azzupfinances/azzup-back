<?php

declare(strict_types=1);

namespace Tests\Feature\Receivables;

use App\Models\Receivable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateReceivableTest extends TestCase
{
    use RefreshDatabase;

    public function test_updates_the_receivable(): void
    {
        $user = User::factory()->create();
        $record = Receivable::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/receivables/{$record->id}", [
            'description' => ' Bike sale ',
            'payer_name' => ' Lucas ',
            'total_cents' => 60000,
            'installments_count' => 3,
            'first_due_date' => '2026-09-05',
        ])
            ->assertOk()
            ->assertJsonPath('data.description', 'Bike sale')
            ->assertJsonPath('data.payer_name', 'Lucas')
            ->assertJsonPath('data.total_cents', 60000)
            ->assertJsonPath('data.installments_count', 3)
            ->assertJsonPath('data.first_due_date', '2026-09-05');
    }

    public function test_rejects_invalid_values(): void
    {
        $user = User::factory()->create();
        $record = Receivable::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/receivables/{$record->id}", [
            'description' => '',
            'payer_name' => '',
            'total_cents' => 0,
            'installments_count' => 25,
            'first_due_date' => '2026-02-30',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['description', 'payer_name', 'total_cents', 'installments_count', 'first_due_date']);
    }

    public function test_forbids_another_users_receivable(): void
    {
        $record = Receivable::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->putJson("/api/receivables/{$record->id}", [
            'description' => ' Bike sale ',
            'payer_name' => ' Lucas ',
            'total_cents' => 60000,
            'installments_count' => 3,
            'first_due_date' => '2026-09-05',
        ])->assertForbidden();
    }

    public function test_requires_authentication(): void
    {
        $record = Receivable::factory()->create();

        $this->putJson("/api/receivables/{$record->id}", [
            'description' => ' Bike sale ',
            'payer_name' => ' Lucas ',
            'total_cents' => 60000,
            'installments_count' => 3,
            'first_due_date' => '2026-09-05',
        ])->assertUnauthorized();
    }
}
