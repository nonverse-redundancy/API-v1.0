<?php

use App\Http\Controllers\Api\Server\VerifyInput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Input Validation Routes
|--------------------------------------------------------------------------
|
| Endpoint: /client/validator
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Validator
Route::prefix('validator')->group(function () {
    Route::post('email', [VerifyInput::class, 'email']);
    Route::post('phone', [VerifyInput::class, 'phone']);
});