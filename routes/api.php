<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\DiskController;
use App\Http\Controllers\ProfileController;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
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
    Route::get('/me', function (Request $request) {
        return response()->json(
            UserResource::make($request->user())
        );
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::post('/set-passcode', [AuthController::class, 'setPasscode'])
        ->name('set-passcode');

    Route::post('/forgot-passcode', [AuthController::class, 'forgotPasscode'])
        ->name('forgot-passcode');

    Route::post('/verify-passcode', [AuthController::class, 'verifyPasscode'])
        ->name('verify-passcode');

    Route::group(['prefix' => 'profile'], function () {
        Route::put('/', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::put('/avatar', [ProfileController::class, 'updateAvatar'])
            ->name('profile.update.avatar');
    });

    Route::get('/notifications', function (Request $request) {
        return response()->json(
            NotificationResource::collection(
                $request->user()->notifications
            )
        );
    });

    Route::group(['prefix' => 'disks'], function () {
        Route::get('/', [DiskController::class, 'index'])
            ->name('disks.index');

        Route::post('/{disk}/pair', [DiskController::class, 'pair'])
            ->name('disks.pair');

        Route::post('/{disk}/unpair', [DiskController::class, 'unpair'])
            ->name('disks.unpair');
    });
   
    Route::group(['prefix' => 'c/'], function () {
        Route::post('rotate', [CommandController::class, 'rotate'])
            ->name('command.rotate');
            
        Route::get('angle', [CommandController::class, 'angle'])
        ->name('command.get-angle');
    });
});
