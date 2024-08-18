<?php

namespace App\Http\Controllers;

use App\Enum\DiskApi;
use App\Http\Requests\RotateDiskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommandController extends Controller
{
    public function rotate(RotateDiskRequest $request)
    {
        $angle = $request->input('angle');

        $disk = auth()->user()->disk;

        $disk->angle = $angle;

        $disk->save();

        try {
            Http::post('http://' . $disk->host . DiskApi::ROTATE->value, [
                'angle' => $angle,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => 'Failed to rotate the disk',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }

        return response()->json([
            'message' => 'Rotating the disk',
        ]);
    }

    public function angle()
    {
        $disk = auth()->user()->disk;

        try {
            $response = Http::get('http://' . $disk->host . DiskApi::ANGLE_STATUS->value);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => 'Failed to get the angle',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }

        return response()->json([
            'angle' => $response->json()['angle'],
        ]);
    }
}
