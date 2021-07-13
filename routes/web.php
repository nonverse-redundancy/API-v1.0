<?php

use App\Http\Controllers\Api\Client\UserDataController;
use App\Http\Controllers\Api\Client\UserRecoveryController;
use App\Http\Controllers\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StatusController::class , 'display']);

// Protected Routes (Requires Login)
Route::prefix('protected')->middleware('auth')->group(function () {

    // Get
    Route::get('/user/{id}', [UserDataController::class, 'show'])->middleware('owner:withadmin');
    Route::get('/user/{id}/recovery', [UserRecoveryController::class, 'show'])->middleware('owner:noadmin');

    // Post
    Route::post('/user/{id}', [UserDataController::class, 'update'])->middleware('owner:noadmin');
    Route::post('/user/{id}/recovery', [UserRecoveryController::class, 'update'])->middleware('owner:noadmin');
});