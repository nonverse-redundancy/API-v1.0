<?php

use App\Http\Controllers\Api\Client\UserDataController;
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
| Endpoint: /user
|
*/
Route::group(['prefix' => 'store'], function() {
    Route::get('/userdata', [UserDataController::class, 'show']);
});