<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

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

        $user = User::query()->where('email', $data['email'])->first();

        return response()->json([
            'status' => "success",
            'message' => "User Logged In Successfully"
        ]);
    }

    public function profile()
    {

    }

    public function logout()
    {

    }
}
