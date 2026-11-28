<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('auth:sanctum');

    /*
    |--------------------------------------------------------------------------
    | Email Verification
    |--------------------------------------------------------------------------
    */

    Route::post('/verify-email', [AuthController::class, 'verifyEmail']);

    Route::post('/resend-email-otp', [AuthController::class, 'resendEmailOtp']);

    /*
    |--------------------------------------------------------------------------
    | Password Reset
    |--------------------------------------------------------------------------
    */

    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});
