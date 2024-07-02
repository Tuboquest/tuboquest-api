<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\SetPasscodeRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json(['message' => 'Invalid credentials'], 422);
        }

        $token = $request->user()->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                ...(new UserResource(
                    $request->user()
                ))->toArray($request),
                'token' => $token
            ],
            200
        );
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(
            [
                ...(new UserResource(
                    $user
                ))->toArray($request),
                'token' => $token
            ],
            201
        );
    }

    public function setPasscode(SetPasscodeRequest $request)
    {
        $user = $request->user();
        $user->passcode = Hash::make($request->passcode);
        $user->save();
        return response()->noContent();
    }

    public function verifyPasscode(Request $request)
    {
        $user = $request->user();
        if (!Hash::check($request->passcode, $user->passcode)) {
            return response()->json(['message' => 'Invalid passcode'], 422);
        }
        return response()->noContent();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }

    public function forgotPassword(Request $request)
    {
    }

    public function forgotPasscode(Request $request)
    {
    }

    public function resetPassword(Request $request)
    {
    }
}
