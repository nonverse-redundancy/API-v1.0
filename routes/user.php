<?php

use App\Http\Controllers\Api\Client\UserDataController;
use App\Http\Controllers\Api\Client\UserRecoveryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Base
Route::get('/', function(Request $request) {
    return array(
        'uuid' => $request->user()->uuid,
    );
});

/*
|--------------------------------------------------------------------------
| User Store Routes
|--------------------------------------------------------------------------
|
| Endpoint: /user/store
|
*/
Route::group(['prefix' => 'store'], function() {
    // Get
    Route::get('/userdata', [UserDataController::class, 'show']);

    // Post
    Route::post('/userdata', [UserDataController::class, 'update']);
});

/*
|--------------------------------------------------------------------------
| User Recovery Routes
|--------------------------------------------------------------------------
|
| Endpoint: /user/recovery
|
*/
Route::group(['prefix' => 'recovery'], function() {
    // Get
    Route::get('/contact', [UserRecoveryController::class, 'show']);

    // Post
    Route::post('/contact', [UserRecoveryController::class, 'update']);
});