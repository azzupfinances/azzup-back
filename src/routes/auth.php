<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\LogoutUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function (): void {
    Route::middleware('throttle:auth')->group(function (): void {
        Route::post('register', RegisterUserController::class)->name('register');
        Route::post('login', LoginUserController::class)->name('login');
    });

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('logout', LogoutUserController::class)->name('logout');
    });
});
