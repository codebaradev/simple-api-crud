<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::query()->create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return response()->json([
            'status' => "success",
            'message' => "User Registered Successfully"
        ]);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email_username'])
            ->orWhere('username', $data['email_username'])
            ->first();

        if ($user || Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => "User Logged In Successfully",
                'token' => $token
            ]);

        } else {
            return response()->json([
                'status' => false,
                'message' => "Username, Email or Password is incorrect"
            ], 401);
        }
    }

    public function profile()
    {

    }

    public function logout()
    {

    }
}
