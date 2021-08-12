<?php

use App\Http\Controllers\api\service\authkey\NewKeyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Minecraft Account Routes
|--------------------------------------------------------------------------
|
| Endpoint: /user/services/authkey/
|
*/
Route::prefix('setup')->group(function () {
    Route::post('/verify-minecraft-username', [NewKeyController::class, 'username']);
    Route::post('/generate-new-key', [NewKeyController::class, 'generate']);
});