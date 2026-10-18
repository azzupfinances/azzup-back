<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Services\Profile\UpdatePasswordService;
use Illuminate\Http\Response;

class UpdatePasswordController extends Controller
{
    public function __invoke(UpdatePasswordRequest $request, UpdatePasswordService $service): Response
    {
        $service->execute($request->user(), $request->validated('password'));

        return response()->noContent();
    }
}
