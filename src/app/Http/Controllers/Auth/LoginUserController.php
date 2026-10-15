<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Services\Auth\LoginUserService;
use Illuminate\Http\JsonResponse;

class LoginUserController extends Controller
{
    public function __invoke(LoginUserRequest $request, LoginUserService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->validated('cpf'), $request->validated('password')),
        ]);
    }
}
