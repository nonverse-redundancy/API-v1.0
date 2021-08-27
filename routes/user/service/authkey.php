<?php

use App\Http\Controllers\api\service\AuthKey\AuthKeyController;
use App\Http\Controllers\api\service\authkey\NewKeyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User AuthKey Setup Routes (Ignores service middleware)
|--------------------------------------------------------------------------
|
| Endpoint: /user/services/authkey/setup/*
|
*/
Route::prefix('setup')->name('setup.key')->group(function () {
    Route::post('/verify-minecraft-username', [NewKeyController::class, 'username']);
    Route::post('/generate-new-key', [NewKeyController::class, 'generate']);
});

/*
|--------------------------------------------------------------------------
| User AuthKey Setup Protected Routes
|--------------------------------------------------------------------------
|
| Endpoint: /user/services/authkey/
|
*/
Route::get('/details', [AuthKeyController::class, 'show']);