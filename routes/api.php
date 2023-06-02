<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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
        Route::get('/all', [UserController::class, 'all'])->name('all');

    });

});

