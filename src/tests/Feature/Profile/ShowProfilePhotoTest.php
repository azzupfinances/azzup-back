<?php

declare(strict_types=1);

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShowProfilePhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_streams_the_photo_of_the_authenticated_user(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('profile-photos/1/me.png', 'image-bytes');
        Sanctum::actingAs(User::factory()->create()->forceFill(['photo_path' => 'profile-photos/1/me.png']));

        $response = $this->get('/api/profile/photo', ['Accept' => 'application/json']);

        $response->assertOk();
        $this->assertSame('image-bytes', $response->streamedContent());
    }

    public function test_returns_not_found_without_a_photo(): void
    {
        Storage::fake('local');
        Sanctum::actingAs(User::factory()->create());

        $this->getJson('/api/profile/photo')->assertNotFound();
    }

    public function test_requires_authentication(): void
    {
        $this->getJson('/api/profile/photo')->assertUnauthorized();
    }
}
