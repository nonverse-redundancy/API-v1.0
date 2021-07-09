<?php

namespace App\Http\Controllers\Api\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerifyInput extends Controller
{
    function email(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->first();
        }
    }
}
