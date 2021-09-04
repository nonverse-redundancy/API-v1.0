<?php

use App\Http\Controllers\api\service\AuthKey\AuthKeyController;
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
    //
});

/*
|--------------------------------------------------------------------------
| User Panel Protected Routes
|--------------------------------------------------------------------------
|
| Endpoint: /user/services/panel/
|
*/