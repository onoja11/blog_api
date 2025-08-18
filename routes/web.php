<?php

use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::with('user')->get();
    return view('welcome', compact('posts'));
});

// Route::apiResource('posts', \App\Http\Controllers\PostController::class)->middleware('api');
// Route::post('/posts', [\App\Http\Controllers\PostController::class,'store'])->middleware('api');
// Route::apiResource('users', UserController::class);