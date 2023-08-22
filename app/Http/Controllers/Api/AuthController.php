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

    public function updateProfile (Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
            $user = $request->user();
            $user->name = $request->input('name');
            $user->email = strtolower($request->input('email'));

            // foto profile
            if ($request->hasFile('picture')) {
                $imageFile = $request->file('picture');
                $imageName = $request->input('name') . '.' . $imageFile->getClientOriginalExtension();
                $imagePath = $imageFile->storeAs('images', $imageName, 'public');
                $user->picture = $imagePath;
            } else {
                $user->picture = $user->picture;
            }

            $user->save();

            return response()->json(['user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating profile.', 'error' => $e->getMessage()], 500);
        }
    }

    public function updatePassword (Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|string|min:8',
            ]);
            
            $user = $request->user();
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return response()->json(['user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating password.', 'error' => $e->getMessage()], 500);
        }
    }
}
