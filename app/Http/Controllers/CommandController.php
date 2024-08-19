<?php

namespace App\Http\Controllers;

use App\Http\Actions\CurrentDiskAngle;
use App\Http\Actions\RotateDisk;
use App\Http\Requests\RotateDiskRequest;

class CommandController extends Controller
{
    public function rotate(RotateDiskRequest $request)
    {
        return (new RotateDisk($request->angle))->handle();
    }

    public function angle()
    {
        return (new CurrentDiskAngle)->handle();
    }
}
