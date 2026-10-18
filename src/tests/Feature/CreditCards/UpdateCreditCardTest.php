<?php

declare(strict_types=1);

namespace Tests\Feature\CreditCards;

use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateCreditCardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, mixed>
     */
    private function payload(): array
    {
        return ['name' => 'Nubank Ultravioleta', 'bank' => 'nubank', 'limit_cents' => 1000000, 'due_day' => 15];
    }

    public function test_updates_the_card(): void
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/credit-cards/{$creditCard->id}", $this->payload())
            ->assertOk()
            ->assertJsonPath('data.name', 'Nubank Ultravioleta')
            ->assertJsonPath('data.limit_cents', 1000000)
            ->assertJsonPath('data.due_day', 15);
    }

    public function test_rejects_invalid_values(): void
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/credit-cards/{$creditCard->id}", [...$this->payload(), 'due_day' => 0])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['due_day']);
    }

    public function test_forbids_another_users_card(): void
    {
        $creditCard = CreditCard::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->putJson("/api/credit-cards/{$creditCard->id}", $this->payload())->assertForbidden();
    }

    public function test_requires_authentication(): void
    {
        $creditCard = CreditCard::factory()->create();

        $this->putJson("/api/credit-cards/{$creditCard->id}", $this->payload())->assertUnauthorized();
    }
}
