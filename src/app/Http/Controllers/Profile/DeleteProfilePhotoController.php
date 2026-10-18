<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\Profile\DeleteProfilePhotoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteProfilePhotoController extends Controller
{
    public function __invoke(Request $request, DeleteProfilePhotoService $service): Response
    {
        $service->execute($request->user());

        return response()->noContent();
    }
}
