<?php

use App\Services\AssetService\Controllers\AssetTheMostTransactionsController;
use App\Services\AssetService\Controllers\AssetTransferController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth:sanctum'])->prefix('api/assets')->name('assets.')->group(function () {
    Route::post('/transfer', AssetTransferController::class)->name('transfer');
    Route::get('/the-most-transactions', AssetTheMostTransactionsController::class)->name('the-most-transactions');
});
