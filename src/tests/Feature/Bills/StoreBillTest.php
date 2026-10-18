<?php

declare(strict_types=1);

namespace Tests\Feature\Bills;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreBillTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_the_bill(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->postJson('/api/bills', [
            'name' => ' Internet ',
            'category' => 'housing',
            'amount_cents' => 9990,
            'due_day' => 8,
        ])
            ->assertCreated()
            ->assertJsonPath('data.name', 'Internet')
            ->assertJsonPath('data.category', 'housing')
            ->assertJsonPath('data.amount_cents', 9990)
            ->assertJsonPath('data.due_day', 8)
            ->assertJsonPath('data.paid_months', []);

        $this->assertDatabaseHas('bills', ['user_id' => $user->id]);
    }

    public function test_rejects_invalid_values(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/bills', [
            'name' => '',
            'category' => 'transport',
            'amount_cents' => 0,
            'due_day' => 32,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'category', 'amount_cents', 'due_day']);
    }

    public function test_requires_authentication(): void
    {
        $this->postJson('/api/bills', [])->assertUnauthorized();
    }
}
