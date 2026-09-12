<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
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

Route::get('/soso', function () {
    return view('welcome');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [AuthController::class, 'user']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/blogs', [BlogController::class, 'store']);
    Route::put('/blogs/{blog}', [BlogController::class, 'update']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);

    // Likes
    Route::post('/blogs/{blog}/like', [LikeController::class, 'store']);
    Route::delete('/blogs/{blog}/like', [LikeController::class, 'destroy']);

    // Comments
    Route::post('/blogs/{blog}/comments', [CommentController::class, 'store']);
    Route::delete('/blogs/{blog}/comments/{comment}', [CommentController::class, 'destroy']);
});