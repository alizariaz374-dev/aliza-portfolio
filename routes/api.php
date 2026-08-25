<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;



//public
Route::post('/login', [AuthController::class, 'login']);
Route::post('/contact', [MessageController::class, 'store']);
Route::apiResource('projects', ProjectsController::class)->only(['index', 'show']);
Route::apiResource('profile', ProfileController::class)->only(['index','show']);
Route::apiResource('skills', SkillController::class)->only(['index','show']);

//protected- admin only
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn (Request $request) => $request->user());
    Route::apiResource('projects', ProjectsController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('skills', SkillController::class)->only(['store', 'update','destroy']);
    Route::apiResource('profile', ProfileController::class)->only(['store', 'update','destroy']);
    Route::get('/get-contact', [MessageController::class, 'index']);
    Route::post('/profile/upload-avatar', [ProfileController::class, 'uploadAvatar']);

});


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => ['required', 'confirmed', Password::defaults()],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'User created successfully',
        'user' => $user,
        'token' => $token,
        'token_type' => 'Bearer',
    ], 201);
});




