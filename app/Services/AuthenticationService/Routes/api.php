<?php

use App\Services\AuthenticationService\Controllers\LoginController;
use App\Services\AuthenticationService\Controllers\LogoutController;
use App\Services\AuthenticationService\Controllers\SendOTPController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api/auth')->name('auth.')->group(function () {
    Route::post('login', LoginController::class)->name('login');
    Route::post('otp', SendOTPController::class)->name('otp');
    Route::middleware('auth:sanctum')->delete('logout', LogoutController::class)->name('logout');
});
