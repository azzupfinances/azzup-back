<?php

declare(strict_types=1);

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdatePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_changes_the_password_and_revokes_other_sessions(): void
    {
        $user = User::factory()->create();
        $currentToken = $user->createToken('auth');
        $user->createToken('auth');

        $this->withToken($currentToken->plainTextToken)
            ->putJson('/api/profile/password', [
                'current_password' => 'password',
                'password' => 'new-secret123',
                'password_confirmation' => 'new-secret123',
            ])
            ->assertNoContent();

        $this->assertTrue(Hash::check('new-secret123', $user->fresh()->password));
        $this->assertSame([$currentToken->accessToken->id], $user->tokens()->pluck('id')->all());
    }

    public function test_rejects_a_wrong_current_password(): void
    {
        $user = User::factory()->create();

        $this->withToken($user->createToken('auth')->plainTextToken)
            ->putJson('/api/profile/password', [
                'current_password' => 'wrong-password',
                'password' => 'new-secret123',
                'password_confirmation' => 'new-secret123',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['current_password']);
    }

    public function test_rejects_an_invalid_new_password(): void
    {
        $user = User::factory()->create();

        $this->withToken($user->createToken('auth')->plainTextToken)
            ->putJson('/api/profile/password', [
                'current_password' => 'password',
                'password' => 'password',
                'password_confirmation' => 'other',
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);
    }

    public function test_requires_authentication(): void
    {
        $this->putJson('/api/profile/password', [])->assertUnauthorized();
    }
}
