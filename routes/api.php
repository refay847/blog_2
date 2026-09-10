<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{blog}', [BlogController::class, 'show']);

Route::get('/test', function () {
    return response()->json([
        'message' => 'Blog API is working!',
    ]);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [AuthController::class, 'user']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/blogs', [BlogController::class, 'store']);

    Route::put('/blogs/{blog}', [BlogController::class, 'update']);

    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);
});