<?php

declare(strict_types=1);

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_updates_personal_data(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $this->patchJson('/api/profile', [
            'name' => 'Maria Souza',
            'email' => ' Maria@Example.com ',
            'phone' => '(21) 3456-7890',
        ])
            ->assertOk()
            ->assertJsonPath('data.name', 'Maria Souza')
            ->assertJsonPath('data.email', 'maria@example.com')
            ->assertJsonPath('data.phone', '2134567890');
    }

    public function test_updates_only_the_salary_block(): void
    {
        $user = User::factory()->create(['name' => 'Maria Souza']);
        Sanctum::actingAs($user);

        $this->patchJson('/api/profile', ['gross_salary_cents' => 650000, 'salary_payment_day' => 10])
            ->assertOk()
            ->assertJsonPath('data.gross_salary_cents', 650000)
            ->assertJsonPath('data.salary_payment_day', 10)
            ->assertJsonPath('data.name', 'Maria Souza');
    }

    public function test_keeps_its_own_email(): void
    {
        $user = User::factory()->create(['email' => 'maria@example.com']);
        Sanctum::actingAs($user);

        $this->patchJson('/api/profile', ['email' => 'maria@example.com'])->assertOk();
    }

    public function test_rejects_an_email_used_by_another_user(): void
    {
        User::factory()->create(['email' => 'taken@example.com']);
        Sanctum::actingAs(User::factory()->create());

        $this->patchJson('/api/profile', ['email' => 'taken@example.com'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_rejects_invalid_values(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->patchJson('/api/profile', [
            'name' => '',
            'phone' => '0123456789',
            'salary_payment_day' => 32,
            'gross_salary_cents' => 0,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'phone', 'salary_payment_day', 'gross_salary_cents']);
    }

    public function test_ignores_the_cpf(): void
    {
        $user = User::factory()->create(['cpf' => '52998224725']);
        Sanctum::actingAs($user);

        $this->patchJson('/api/profile', ['cpf' => '11144477735'])->assertOk();

        $this->assertSame('52998224725', $user->fresh()->cpf);
    }

    public function test_requires_authentication(): void
    {
        $this->patchJson('/api/profile', ['name' => 'Maria Souza'])->assertUnauthorized();
    }
}
