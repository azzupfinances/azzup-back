<?php

use App\Http\Controllers\Profile\DeleteProfilePhotoController;
use App\Http\Controllers\Profile\ShowProfileController;
use App\Http\Controllers\Profile\ShowProfilePhotoController;
use App\Http\Controllers\Profile\UpdatePasswordController;
use App\Http\Controllers\Profile\UpdateProfileController;
use App\Http\Controllers\Profile\UpdateProfilePhotoController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->name('profile.')->middleware('auth:sanctum')->group(function (): void {
    Route::get('/', ShowProfileController::class)->name('show');
    Route::patch('/', UpdateProfileController::class)->name('update');

    // Throttled like login: a stolen session must not brute-force the current password.
    Route::put('password', UpdatePasswordController::class)->middleware('throttle:auth')->name('update-password');

    Route::get('photo', ShowProfilePhotoController::class)->name('show-photo');
    Route::post('photo', UpdateProfilePhotoController::class)->name('update-photo');
    Route::delete('photo', DeleteProfilePhotoController::class)->name('delete-photo');
});
