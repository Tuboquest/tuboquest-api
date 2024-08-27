<?php

namespace App\Commands;

use Illuminate\Support\Facades\Http;
use App\Enum\DiskApi;

class RotateDisk extends Command
{
    public function handle(
        int $angle
    ) {
        $disk = $this->getDisk();

        if ($disk) {
            if ($disk->angle === $angle) {
                return response()->json([
                    'message' => 'The disk is already at the requested angle',
                ], 400);
            }

            try {
                if ($this->allowedToMakeRequests()) {
                    $response = Http::post('http://' . $disk->host . DiskApi::ROTATE->value, [
                        'angle' => $angle,
                        'disk_token' => $disk->token
                    ]);

                    if ($response->status() === 401) {
                        return response()->json(
                            [
                                'message' => 'Failed to rotate the disk',
                                'error' => 'Unauthorized',
                            ],
                            401
                        );
                    }
                }

                $disk->angle += $angle;
                $disk->save();
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
                'message' => 'Disk rotated successfully',
            ], 200);
        }

        return response()->json([
            'message' => 'Disk not found',
        ], 404);
    }
}
