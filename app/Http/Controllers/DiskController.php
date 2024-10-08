<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBatteryRequest;
use App\Http\Resources\DiskResource;
use App\Models\Disk;
use Illuminate\Http\Request;

class DiskController extends Controller
{
    public function index()
    {
        return response()->json(
            DiskResource::collection(
                Disk::unpaired()->get()
            )
        );
    }

    public function current(Request $request)
    {
        $disk = $request->attributes->get('disk');

        if ($disk === null) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json(
            new DiskResource($disk)
        );
    }

    public function battery(UpdateBatteryRequest $request)
    {
        $disk = $request->attributes->get('disk');

        if ($disk === null) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $disk->battery = $request->input('battery');
        $disk->save();

        return response()->json([], 204);
    }

    public function event(Request $request)
    {
        return response()->json([], 204);
    }

    public function pair(Disk $disk, Request $request)
    {
        $user = auth()->user();

        if ($user->disk !== null) {
            return response()->json([
                'message' => 'You already have a disk paired'
            ], 400);
        }

        if ($disk->user !== null || $disk->is_paired) {
            return response()->json([
                'message' => 'Disk already paired'
            ], 400);
        }

        $pairingCode = $request->input('pairing_code');

        if (
            $disk->pairing_code === $pairingCode &&
            $disk->user_id === null
        ) {
            $disk->is_paired = true;
            $disk->user_id = $user->id;
            $disk->save();

            return response()->json([
                'message' => 'Disk paired successfully'
            ]);
        }

        return response()->json([
            'message' => 'Invalid pairing code'
        ], 400);
    }

    public function unpair(Disk $disk)
    {
        $user = auth()->user();

        if ($disk->user_id !== $user->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        if (!$disk->is_paired) {
            return response()->json([
                'message' => 'Disk not paired'
            ], 400);
        }

        $disk->user_id = null;
        $disk->is_paired = false;
        $disk->save();

        return response()->json([
            'message' => 'Disk unpaired successfully'
        ]);
    }
}
