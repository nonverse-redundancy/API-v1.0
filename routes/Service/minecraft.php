<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Service\Minecraft\ProfileController;

/*
|--------------------------------------------------------------------------
| User Minecraft Account Routes
|--------------------------------------------------------------------------
|
| Endpoint: /user/service/minecraft/
|
*/

Route::get('/profile', [ProfileController::class, 'show']);