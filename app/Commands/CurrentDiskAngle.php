<?php

namespace App\Commands;

use Illuminate\Support\Facades\Http;
use App\Enum\DiskApi;

class CurrentDiskAngle extends Command
{
    public function handle()
    {
        $disk = $this->getDisk();
        $angle = $disk->angle;

        try {
            if ($this->allowedToMakeRequests()) {
                $response = Http::post('http://' . $disk->host . DiskApi::ANGLE_STATUS->value, [
                    'disk_token' => $disk->token
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

                $angle = $response->json()['angle'];
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
            'angle' => $angle,
        ]);
    }
}
