<?php

use App\Http\Controllers\Transactions\DeleteTransactionController;
use App\Http\Controllers\Transactions\ListTransactionsController;
use App\Http\Controllers\Transactions\ShowAnnualSummaryController;
use App\Http\Controllers\Transactions\StoreTransactionController;
use App\Http\Controllers\Transactions\UpdateTransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('transactions')->name('transactions.')->middleware('auth:sanctum')->group(function (): void {
    Route::get('/', ListTransactionsController::class)->name('list');
    Route::get('annual-summary', ShowAnnualSummaryController::class)->name('annual-summary');
    Route::post('/', StoreTransactionController::class)->name('store');
    Route::put('{transaction}', UpdateTransactionController::class)->name('update');
    Route::delete('{transaction}', DeleteTransactionController::class)->name('delete');
});
