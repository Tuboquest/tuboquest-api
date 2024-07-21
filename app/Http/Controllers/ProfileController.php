<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        
        try {
            $user->update($request->validated());

            return response()->json(
                UserResource::make($user)
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating profile',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $user = $request->user();

        try {
            $user->update([
                'avatar' => $request->avatar ?? $user->avatar,
            ]);

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating profile',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
