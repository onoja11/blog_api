<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::apiResource('posts', \App\Http\Controllers\PostController::class)->middleware('api');
// Route::post('/posts', [\App\Http\Controllers\PostController::class,'store'])->middleware('api');
// Route::apiResource('users', UserController::class);