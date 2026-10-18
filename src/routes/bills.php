<?php

use App\Http\Controllers\Bills\DeleteBillController;
use App\Http\Controllers\Bills\ListBillsController;
use App\Http\Controllers\Bills\MarkBillPaidController;
use App\Http\Controllers\Bills\StoreBillController;
use App\Http\Controllers\Bills\UnmarkBillPaidController;
use App\Http\Controllers\Bills\UpdateBillController;
use Illuminate\Support\Facades\Route;

Route::prefix('bills')->name('bills.')->middleware('auth:sanctum')->group(function (): void {
    Route::get('/', ListBillsController::class)->name('list');
    Route::post('/', StoreBillController::class)->name('store');
    Route::put('{bill}', UpdateBillController::class)->name('update');
    Route::delete('{bill}', DeleteBillController::class)->name('delete');
    Route::put('{bill}/paid-months/{month}', MarkBillPaidController::class)->name('mark-paid');
    Route::delete('{bill}/paid-months/{month}', UnmarkBillPaidController::class)->name('unmark-paid');
});
