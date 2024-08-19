<?php

namespace App\Http\Actions;

use App\Models\Disk;
use Illuminate\Support\Facades\Http;
use App\Enum\DiskApi;
use Illuminate\Support\Facades\Auth;

class RotateDisk
{
    private Disk $disk = null;

    public function __construct(
        private int $angle,
    )
    {
        $this->disk = Auth::user()->disk;
    }

    public function handle()
    {
        $this->disk->angle = $this->angle;

        $this->disk->save();

        try {
            Http::post('http://' . $this->disk->host . DiskApi::ROTATE->value, [
                'angle' => $this->angle,
                'user_token' => Auth::user()->token,
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
}