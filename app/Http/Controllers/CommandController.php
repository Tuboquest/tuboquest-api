<?php

namespace App\Http\Controllers;

use App\Actions\CurrentDiskAngle;
use App\Actions\RotateDisk;
use App\Http\Requests\RotateDiskRequest;

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
