<?php

use App\Http\Controllers\api\service\AuthKey\AuthKeyController;
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
Route::prefix('setup')->name('setup.authkey')->group(function () {
    Route::post('/verify-minecraft-username', [AuthKeyController::class, 'verify']);
    Route::post('/generate-new-key', [AuthKeyController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| User AuthKey Protected Routes
|--------------------------------------------------------------------------
|
| Endpoint: /user/services/authkey/
|
*/
Route::get('/details', [AuthKeyController::class, 'show']);