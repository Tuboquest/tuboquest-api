<?php

namespace App\Commands;

class CurrentDiskAngle extends Command
{
    public function handle()
    {
        $disk = $this->getDisk();
        $angle = $disk->angle;

        return response()->json([
            'angle' => $angle,
        ]);
    }
}
