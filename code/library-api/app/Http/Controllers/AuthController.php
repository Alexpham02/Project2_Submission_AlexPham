<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // deletes the old tokens
        $user->tokens()->delete();

        // Access token
        $accessToken = $user->createToken('access-token', ['access'])->plainTextToken;

        // Refreshs token 
        $refreshToken = $user->createToken('refresh-token', ['refresh'])->plainTextToken;

        return response()->json([
            'access_token'  => $accessToken,
            'refresh_token' => $refreshToken,
        ]);
    }

    public function refresh(Request $request)
    {
        $tokenString = $request->bearerToken();

        if (! $tokenString) {
            return response()->json(['message' => 'Missing refresh token'], 401);
        }

        $token = PersonalAccessToken::findToken($tokenString);

        if (! $token || ! $token->can('refresh')) {
            return response()->json(['message' => 'Invalid refresh token'], 401);
        }

        $user = $token->tokenable;

        $newAccessToken = $user->createToken('access-token', ['access'])->plainTextToken;

        return response()->json([
            'access_token' => $newAccessToken,
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}


