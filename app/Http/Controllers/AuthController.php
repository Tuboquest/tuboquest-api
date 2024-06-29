<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SetPasscodeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $request->authenticate();
    
        $token = $request->user()->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                ...$request->user()->toArray(),
                'token' => $token
            ],
            200
        );
    }

    public function register(RegisterRequest $request) {
        $user = User::create($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(
            [
                ...$user->toArray(),
                'token' => $token
            ],
            201
        );
    }

    public function setPasscode(SetPasscodeRequest $request) {
        $user = $request->user();
        $user->passcode = Hash::make($request->passcode);
        $user->save();
        return $user;
    }

    public function verifyPasscode(Request $request) {
        $user = $request->user();
        if (!Hash::check($request->passcode, $user->passcode)) {
            return response()->json(['message' => 'Invalid passcode'], 422);
        }
        return response()->noContent();
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }

    public function forgotPassword(Request $request) {
    }

    public function resetPassword(Request $request) {}
}
