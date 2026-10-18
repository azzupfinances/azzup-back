<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_logs_in_with_cpf_and_password(): void
    {
        $user = User::factory()->create(['cpf' => '52998224725']);

        $response = $this->postJson('/api/auth/login', [
            'cpf' => '529.982.247-25',
            'password' => 'password',
        ]);

        $response->assertOk()
            ->assertJsonPath('data.user.id', $user->id)
            ->assertJsonStructure(['data' => ['user', 'token']]);

        $this->assertCount(1, $user->tokens);
    }

    public function test_rejects_a_wrong_password(): void
    {
        User::factory()->create(['cpf' => '52998224725']);

        $this->postJson('/api/auth/login', ['cpf' => '52998224725', 'password' => 'wrong-password'])
            ->assertUnauthorized()
            ->assertJsonPath('message', 'Invalid credentials.');
    }

    public function test_rejects_an_unknown_cpf(): void
    {
        $this->postJson('/api/auth/login', ['cpf' => '52998224725', 'password' => 'password'])
            ->assertUnauthorized()
            ->assertJsonPath('message', 'Invalid credentials.');
    }

    public function test_rejects_missing_fields(): void
    {
        $this->postJson('/api/auth/login', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['cpf', 'password']);
    }

    public function test_throttles_repeated_attempts(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/api/auth/login', ['cpf' => '52998224725', 'password' => 'wrong'])
                ->assertUnauthorized();
        }

        $this->postJson('/api/auth/login', ['cpf' => '52998224725', 'password' => 'wrong'])
            ->assertTooManyRequests();
    }

    public function test_throttles_each_client_ip_reported_by_a_trusted_proxy(): void
    {
        // Test requests come from 127.0.0.1, standing in for the web front end's server.
        config(['trustedproxy.proxies' => '127.0.0.1']);

        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/api/auth/login', ['cpf' => '52998224725', 'password' => 'wrong'], ['X-Forwarded-For' => '203.0.113.10'])
                ->assertUnauthorized();
        }

        $this->postJson('/api/auth/login', ['cpf' => '52998224725', 'password' => 'wrong'], ['X-Forwarded-For' => '203.0.113.10'])
            ->assertTooManyRequests();

        $this->postJson('/api/auth/login', ['cpf' => '52998224725', 'password' => 'wrong'], ['X-Forwarded-For' => '203.0.113.20'])
            ->assertUnauthorized();
    }

    public function test_ignores_the_forwarded_ip_from_an_untrusted_caller(): void
    {
        config(['trustedproxy.proxies' => null]);

        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/api/auth/login', ['cpf' => '52998224725', 'password' => 'wrong'], ['X-Forwarded-For' => "203.0.113.{$i}"])
                ->assertUnauthorized();
        }

        $this->postJson('/api/auth/login', ['cpf' => '52998224725', 'password' => 'wrong'], ['X-Forwarded-For' => '203.0.113.99'])
            ->assertTooManyRequests();
    }
}
