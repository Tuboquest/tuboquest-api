<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])
        ->name('forgot-password');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('reset-password');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::post('/set-passcode', [AuthController::class, 'setPasscode'])
        ->name('set-passcode');

    Route::post('/forgot-passcode', [AuthController::class, 'forgotPasscode'])
        ->name('forgot-passcode');

    Route::post('/verify-passcode', [AuthController::class, 'verifyPasscode'])
        ->name('verify-passcode');
});