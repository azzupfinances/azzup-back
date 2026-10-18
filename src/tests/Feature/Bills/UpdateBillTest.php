<?php

declare(strict_types=1);

namespace Tests\Feature\Bills;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateBillTest extends TestCase
{
    use RefreshDatabase;

    public function test_updates_the_bill(): void
    {
        $user = User::factory()->create();
        $record = Bill::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/bills/{$record->id}", [
            'name' => ' Internet ',
            'category' => 'housing',
            'amount_cents' => 9990,
            'due_day' => 8,
        ])
            ->assertOk()
            ->assertJsonPath('data.name', 'Internet')
            ->assertJsonPath('data.category', 'housing')
            ->assertJsonPath('data.amount_cents', 9990)
            ->assertJsonPath('data.due_day', 8);
    }

    public function test_rejects_invalid_values(): void
    {
        $user = User::factory()->create();
        $record = Bill::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/bills/{$record->id}", [
            'name' => '',
            'category' => 'transport',
            'amount_cents' => 0,
            'due_day' => 32,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'category', 'amount_cents', 'due_day']);
    }

    public function test_forbids_another_users_bill(): void
    {
        $record = Bill::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->putJson("/api/bills/{$record->id}", [
            'name' => ' Internet ',
            'category' => 'housing',
            'amount_cents' => 9990,
            'due_day' => 8,
        ])->assertForbidden();
    }

    public function test_requires_authentication(): void
    {
        $record = Bill::factory()->create();

        $this->putJson("/api/bills/{$record->id}", [
            'name' => ' Internet ',
            'category' => 'housing',
            'amount_cents' => 9990,
            'due_day' => 8,
        ])->assertUnauthorized();
    }
}
