<?php

use App\Http\Controllers\Receivables\DeleteReceivableController;
use App\Http\Controllers\Receivables\ListReceivablesController;
use App\Http\Controllers\Receivables\MarkReceivableReceivedController;
use App\Http\Controllers\Receivables\StoreReceivableController;
use App\Http\Controllers\Receivables\UnmarkReceivableReceivedController;
use App\Http\Controllers\Receivables\UpdateReceivableController;
use Illuminate\Support\Facades\Route;

Route::prefix('receivables')->name('receivables.')->middleware('auth:sanctum')->group(function (): void {
    Route::get('/', ListReceivablesController::class)->name('list');
    Route::post('/', StoreReceivableController::class)->name('store');
    Route::put('{receivable}', UpdateReceivableController::class)->name('update');
    Route::delete('{receivable}', DeleteReceivableController::class)->name('delete');
    Route::put('{receivable}/received-months/{month}', MarkReceivableReceivedController::class)->name('mark-received');
    Route::delete('{receivable}/received-months/{month}', UnmarkReceivableReceivedController::class)->name('unmark-received');
});
