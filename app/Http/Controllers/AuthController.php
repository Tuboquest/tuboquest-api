<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SetPasscodeRequest;
use App\Mail\Connexion;
use App\Mail\ForgotPasscode;
use App\Mail\ForgotPassword;
use App\Mail\PasscodeUpdated;
use App\Mail\PasswordUpdated;
use App\Mail\Welcome;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json(['message' => 'Invalid credentials'], 422);
        }

        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;
        Mail::to($user->email)->send(new Connexion());
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
        Mail::to($user->email)->send(new Welcome($user->email));
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
        Mail::to($user->email)->send(new PasscodeUpdated());
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

    public function forgotPassword()
    {
        try {
            $user = auth()->user();
            Mail::to($user->email)->send(new ForgotPassword());
            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function forgotPasscode()
    {
        try {
            $user = auth()->user();
            Mail::to($user->email)->send(new ForgotPasscode());
            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            auth()->user->password = Hash::make($request->password);
            auth()->user->save();
            Mail::to(auth()->user()->email)->send(new PasswordUpdated());
            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }
}
