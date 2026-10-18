<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ShowProfilePhotoController extends Controller
{
    public function __invoke(Request $request, FilesystemFactory $storage): StreamedResponse
    {
        $path = $request->user()->photo_path;
        $disk = $storage->disk('local');

        abort_if($path === null || ! $disk->exists($path), 404, 'Profile photo not found.');

        return $disk->response($path, headers: ['Cache-Control' => 'private, no-cache']);
    }
}
