<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\batteryStatus;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

// Route::get('/battery-lvl', [BatteryStatus::class, 'getBatteryLvL']);
// Route::get('/send-notification',[BatteryStatus::class, 'sendNotification']);

Route::get('/send-test-email', function () {
    Mail::to('your_email@example.com')->send(new TestEmail());
    return 'Email envoyé avec succès!';
});