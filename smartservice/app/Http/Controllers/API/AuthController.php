<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole('admin', 'customer');

        $user->givePermissionTo('update service');
        
        return response()->json([
            'success' => true,
            'message' => "User Registered Successfully",
            'user' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'This email is not registered to our database. Please Register now',
            ]);
        } else {
            if (!Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => 'Invalid password',
                ]);
            }
            else{
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'message' => 'Successfully Login',
                    'token' => $token,
                    'user' => $user,
                ], 200);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successfull']);
    }

    public function me(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }

}
