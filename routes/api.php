<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('students', StudentController::class);

Route::middleware(['guest:sanctum'])->group(function () {
    Route::post('/users/register', [UserController::class, 'register'])
        ->name('users.register');

    Route::post('/users/login', [UserController::class, 'login'])
        ->name('users.login');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/profile', [UserController::class, 'profile'])
        ->name('users.profile');

    Route::delete('/users/logout', [UserController::class, 'logout'])
        ->name('users.logout');
});

