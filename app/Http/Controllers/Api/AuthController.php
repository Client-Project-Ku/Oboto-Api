<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register (Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users|max:255',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => strtolower($request->input('email')),
                'password' => Hash::make($request->input('password')),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function login (Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            if (!auth()->attempt($credentials)) {
                return response()->json(['message' => 'Invalid login credentials.'], 401);
            }

            $user = User::where('email', strtolower($request->input('email')))->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Login failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function logout (Request $request)
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json(['message' => 'Logged out.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Logout failed.', 'error' => $e->getMessage()], 500);
        }
    }

    public function user (Request $request)
    {
        try {
            return response()->json(['user' => $request->user()]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching user.', 'error' => $e->getMessage()], 500);
        }
    }
}
