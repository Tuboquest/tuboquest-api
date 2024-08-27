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
            try {
                if ($this->allowedToMakeRequests()) {
                    $response = Http::withHeaders([
                        "Authorization" => "Bearer {$disk->token}",
                    ])->post(
                        'http://' . $disk->host . DiskApi::ROTATE->value,
                        [
                            "angle" => $angle,
                            "date" => now()->format("MM/DD/YYYY"),
                        ]
                    );

                    if ($response->status() === 401) {
                        return response()->json(
                            [
                                'message' => 'Failed to rotate the disk',
                                'error' => 'Unauthorized',
                            ],
                            401
                        );
                    }

                    $disk->movements()->create([
                        'angle' => $angle,
                        'user_id' => $disk->user_id,
                    ]);
                    $disk->angle = $angle;
                    $disk->save();
                } else {
                    $disk->angle += $angle;
                    $disk->save();
                }
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
