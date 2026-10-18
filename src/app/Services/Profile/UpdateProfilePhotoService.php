<?php

declare(strict_types=1);

namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\UploadedFile;

class UpdateProfilePhotoService
{
    // Private disk: photos are served only through the authenticated photo endpoint.
    private const DISK = 'local';

    public function __construct(private readonly FilesystemFactory $storage) {}

    public function execute(User $user, UploadedFile $photo): User
    {
        $previousPath = $user->photo_path;
        $path = $photo->store("profile-photos/{$user->id}", self::DISK);

        $user->forceFill(['photo_path' => $path])->save();

        if ($previousPath !== null) {
            $this->storage->disk(self::DISK)->delete($previousPath);
        }

        return $user;
    }
}
