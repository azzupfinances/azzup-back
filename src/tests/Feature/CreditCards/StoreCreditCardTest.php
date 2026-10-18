<?php

declare(strict_types=1);

namespace Tests\Feature\CreditCards;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreCreditCardTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_card(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->postJson('/api/credit-cards', [
            'name' => ' Inter ',
            'bank' => 'banco_do_brasil',
            'limit_cents' => 300000,
            'due_day' => 5,
        ])
            ->assertCreated()
            ->assertJsonPath('data.name', 'Inter')
            ->assertJsonPath('data.bank', 'banco_do_brasil')
            ->assertJsonPath('data.paid_invoice_months', []);

        $this->assertDatabaseHas('credit_cards', ['user_id' => $user->id, 'name' => 'Inter']);
    }

    public function test_rejects_invalid_values(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/credit-cards', [
            'name' => '',
            'bank' => 'unknown',
            'limit_cents' => 0,
            'due_day' => 32,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'bank', 'limit_cents', 'due_day']);
    }

    public function test_requires_authentication(): void
    {
        $this->postJson('/api/credit-cards', [])->assertUnauthorized();
    }
}
