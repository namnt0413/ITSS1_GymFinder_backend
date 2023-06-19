<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\OptionController;

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
        Route::post('/filter-gyms', [UserController::class, 'filterGyms']);
        Route::get('/detail-gym/{id}', [UserController::class, 'detailGym']);
    });

    // Post
    Route::name('posts.')->prefix('post')->group(function () {
        Route::get('/recent-posts', [PostController::class, 'recentPosts']);
        Route::post('/filter-posts', [PostController::class, 'filterPosts']);
        Route::get('/detail-post/{id}', [PostController::class, 'detailPost']);
    });

    // Option
    Route::name('options.')->prefix('option')->group(function () {
        Route::get('/all', [OptionController::class, 'all']);
    });

});

