<?php

namespace App\Actions;

use App\Models\Disk;
use Illuminate\Support\Facades\Http;
use App\Enum\DiskApi;
use Illuminate\Support\Facades\Auth;

class CurrentDiskAngle
{

    private ?Disk $disk = null;

    public function __construct()
    {
        $this->disk = Auth::user()->disk;
    }

    public function handle()
    {
        try {
            $response = Http::post('http://' . $this->disk->host . DiskApi::ANGLE_STATUS->value, [
                'disk_token' => $this->disk->token
            ]);

            if ($response->status() === 401) {
                return response()->json(
                    [
                        'message' => 'Failed to get the angle',
                        'error' => 'Unauthorized',
                    ],
                    401
                );
            }
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
