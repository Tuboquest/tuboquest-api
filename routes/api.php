<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiskController;
use App\Http\Controllers\EmailController;
use App\Mail\Welcome;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:sanctum'])->group(function () {
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
    Route::post('/test', function (Request $request) {
        Mail::to($request->user())->queue(new Welcome());
        return response()->json(['message' => 'Email sent successfully']);
    });

    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::get('/disks', [DiskController::class, 'index'])
        ->name('disks.index');

    Route::post('/disks/{disk}/pair', [DiskController::class, 'pair'])
        ->name('disks.pair');

    Route::post('/disks/{disk}/unpair', [DiskController::class, 'unpair'])
        ->name('disks.unpair');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::post('/set-passcode', [AuthController::class, 'setPasscode'])
        ->name('set-passcode');

    Route::post('/forgot-passcode', [AuthController::class, 'forgotPasscode'])
        ->name('forgot-passcode');

    Route::post('/verify-passcode', [AuthController::class, 'verifyPasscode'])
        ->name('verify-passcode');
});
