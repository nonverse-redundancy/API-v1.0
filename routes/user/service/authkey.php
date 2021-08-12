<?php

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

Route::get('/details', function() {
    return "Yipee";
});