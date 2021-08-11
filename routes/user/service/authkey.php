<?php

use App\Http\Controllers\api\service\authkey\NewKeyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Minecraft Account Routes
|--------------------------------------------------------------------------
|
| Endpoint: /user/service/authkey/
|
*/

Route::post('/initialize-new-key', [NewKeyController::class, 'initialize']);