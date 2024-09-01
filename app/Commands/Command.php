<?php

namespace App\Commands;

use App\Models\Disk;
use Illuminate\Support\Facades\Auth;

class Command
{
    private ?Disk $disk = null;

    public static bool $fakeRequests = false;

    public function __construct()
    {
        $this->disk = Auth::user()->disk;
        // $this->fakeRequests = env('DISK_REQUESTS_DISABLED');
    }

    public function getDisk(): ?Disk
    {
        return $this->disk;
    }

    public function allowedToMakeRequests(): bool
    {
        return $this->disk !== null && ! self::$fakeRequests;
    }
}
