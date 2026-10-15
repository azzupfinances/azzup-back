<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_revokes_the_current_token(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth')->plainTextToken;

        $this->withToken($token)
            ->postJson('/api/auth/logout')
            ->assertNoContent();

        $this->assertCount(0, $user->tokens()->get());
    }

    public function test_requires_authentication(): void
    {
        $this->postJson('/api/auth/logout')
            ->assertUnauthorized()
            ->assertJsonPath('message', 'Unauthenticated.');
    }
}
