<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Maria Silva',
            'cpf' => '529.982.247-25',
            'email' => 'maria@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'salary_payment_day' => 5,
        ], $overrides);
    }

    public function test_registers_a_user_and_returns_a_token(): void
    {
        $response = $this->postJson('/api/auth/register', $this->payload());

        $response->assertCreated()
            ->assertJsonPath('data.user.cpf', '52998224725')
            ->assertJsonPath('data.user.salary_payment_day', 5)
            ->assertJsonMissingPath('data.user.password')
            ->assertJsonStructure(['data' => ['user', 'token'], 'message']);

        $user = User::firstWhere('cpf', '52998224725');
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('secret123', $user->password));
        $this->assertStringStartsWith('$argon2id$', $user->password);
        $this->assertCount(1, $user->tokens);
    }

    public function test_rejects_missing_fields(): void
    {
        $this->postJson('/api/auth/register', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'cpf', 'email', 'password', 'salary_payment_day']);
    }

    public function test_rejects_an_invalid_cpf(): void
    {
        $this->postJson('/api/auth/register', $this->payload(['cpf' => '111.111.111-11']))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['cpf']);
    }

    public function test_rejects_a_duplicate_cpf(): void
    {
        User::factory()->create(['cpf' => '52998224725']);

        $this->postJson('/api/auth/register', $this->payload())
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['cpf']);
    }

    public function test_rejects_a_duplicate_email(): void
    {
        User::factory()->create(['email' => 'maria@example.com']);

        $this->postJson('/api/auth/register', $this->payload(['email' => 'MARIA@example.com']))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_rejects_a_short_password(): void
    {
        $this->postJson('/api/auth/register', $this->payload([
            'password' => 'short',
            'password_confirmation' => 'short',
        ]))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);
    }

    public function test_rejects_an_unconfirmed_password(): void
    {
        $this->postJson('/api/auth/register', $this->payload(['password_confirmation' => 'different123']))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);
    }

    public function test_rejects_a_salary_payment_day_out_of_range(): void
    {
        foreach ([0, 32] as $day) {
            $this->postJson('/api/auth/register', $this->payload(['salary_payment_day' => $day]))
                ->assertUnprocessable()
                ->assertJsonValidationErrors(['salary_payment_day']);
        }
    }
}
