<?php

declare(strict_types=1);

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteProfilePhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_removes_the_photo(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('profile-photos/1/me.png', 'image-bytes');
        $user = User::factory()->create();
        $user->forceFill(['photo_path' => 'profile-photos/1/me.png'])->save();
        Sanctum::actingAs($user);

        $this->deleteJson('/api/profile/photo')->assertNoContent();

        Storage::disk('local')->assertMissing('profile-photos/1/me.png');
        $this->assertNull($user->fresh()->photo_path);
    }

    public function test_requires_authentication(): void
    {
        $this->deleteJson('/api/profile/photo')->assertUnauthorized();
    }
}
