<?php

use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::get('user', [LoginController::class, 'currentUser'])->middleware('auth:sanctum');

Route::get('posts', [PostController::class, 'index'])->middleware('auth:sanctum');
Route::post('posts', [PostController::class, 'store'])->middleware('auth:sanctum');
Route::get('posts/{id}', [PostController::class, 'show'])->middleware('auth:sanctum');
Route::delete('posts/{id}', [PostController::class, 'destroy'])->middleware('auth:sanctum');
Route::put('posts/update/{id}', [PostController::class, 'update'])->middleware('auth:sanctum');
