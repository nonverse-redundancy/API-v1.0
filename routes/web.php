<?php

use App\Http\Controllers\Api\Client\UserDataController;
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
    Route::get('/user/view/{id}', [UserDataController::class, 'show'])->middleware('owner:withadmin');

    // Post
    Route::post('/user/update/{id}', [UserDataController::class, 'update'])->middleware('owner:noadmin');
});