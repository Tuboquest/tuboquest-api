<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();

        $user->update($request->validated());

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user,
        ]);
    }

    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $user = $request->user();

        $user->update([
            'avatar' => $request->avatar ?? $user->avatar,
        ]);

        return response()->json([
            'message' => 'Avatar updated successfully',
            'user' => $user,
        ]);
    }
}
