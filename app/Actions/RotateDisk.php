<?php

namespace App\Actions;

use App\Models\Disk;
use Illuminate\Support\Facades\Http;
use App\Enum\DiskApi;
use Illuminate\Support\Facades\Auth;

class RotateDisk
{
    private ?Disk $disk = null;

    public function handle(
        int $angle
    ) {
        $this->disk = Auth::user()->disk;

        if ($this->disk) {
            if ($this->disk->angle === $angle) {
                return response()->json([
                    'message' => 'The disk is already at the requested angle',
                ]);
            }

            try {
                Http::post('http://' . $this->disk->host . DiskApi::ROTATE->value, [
                    'angle' => $angle,
                    'disk_token' => $this->disk->token,
                    'user_token' => Auth::user()->token,
                ]);

                $this->disk->angle = $angle;
                $this->disk->save();
            } catch (\Exception $e) {
                return response()->json(
                    [
                        'message' => 'Failed to rotate the disk',
                        'error' => $e->getMessage(),
                    ],
                    500,
                );
            }
        }

        return response()->json([
            'message' => 'Rotating the disk',
        ]);
    }
}
