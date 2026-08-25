<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;



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



