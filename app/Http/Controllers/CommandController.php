<?php

namespace App\Http\Controllers;

use App\Http\Requests\RotateDiskRequest;

use App\Commands\CurrentDiskAngle;
use App\Commands\RotateDisk;

class CommandController extends Controller
{
    public function rotate(RotateDiskRequest $request)
    {
        return (new RotateDisk)->handle($request->angle);
    }

    public function angle()
    {
        return (new CurrentDiskAngle)->handle();
    }
}
