<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Users MUST have the 'admin' role to access these routes
|
*/

Route::get('/test', function() {
    return 'Test';
});