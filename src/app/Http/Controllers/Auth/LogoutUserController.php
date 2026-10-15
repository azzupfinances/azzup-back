<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LogoutUserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutUserController extends Controller
{
    public function __invoke(Request $request, LogoutUserService $service): Response
    {
        $service->execute($request->user());

        return response()->noContent();
    }
}
