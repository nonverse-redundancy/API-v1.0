<?php

use App\Http\Controllers\Api\Service\Panel\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User AuthKey Setup Routes (Ignores service middleware)
|--------------------------------------------------------------------------
|
| Endpoint: /user/services/panel/setup/*
|
*/
Route::prefix('setup')->name('setup.panel')->group(function () {
    Route::post('/create-panel-user',[UserController::class, 'create']);
});

/*
|--------------------------------------------------------------------------
| User Panel Protected Routes
|--------------------------------------------------------------------------
|
| Endpoint: /user/services/panel/
|
*/