<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([ 'as' => ''], function () {
    // User
    // Route::apiResource('users', \App\Http\Controllers\Api\UserController::class);    TH su dung api resource
    Route::name('users.')->prefix('user')->group(function () {
        Route::get('/recent-gyms', [UserController::class, 'recentGyms']);
        Route::get('/list-gyms', [UserController::class, 'listGyms']);
        Route::get('/filter-gyms', [UserController::class, 'filterGyms']);
    });

    // Post
    Route::name('posts.')->prefix('post')->group(function () {
        Route::get('/recent-posts', [PostController::class, 'recentPosts']);
        Route::get('/filter-posts', [PostController::class, 'filterPosts']);

    });

});

