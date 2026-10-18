<?php

declare(strict_types=1);

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShowProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_the_authenticated_user(): void
    {
        $user = User::factory()->create(['gross_salary_cents' => 650000, 'photo_path' => 'profile-photos/1/photo.jpg']);
        Sanctum::actingAs($user);

        $this->getJson('/api/profile')
            ->assertOk()
            ->assertJsonPath('data.id', $user->id)
            ->assertJsonPath('data.gross_salary_cents', 650000)
            ->assertJsonPath('data.has_photo', true)
            ->assertJsonMissingPath('data.photo_path')
            ->assertJsonMissingPath('data.password');
    }

    public function test_requires_authentication(): void
    {
        $this->getJson('/api/profile')->assertUnauthorized();
    }
}
