<?php

namespace App\Http\Controllers\Api\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerifyInput extends Controller
{
    function email(Request $request) {
        
        if ($request->has('args')) {
            $args = $request->query('args');
            if ($args === 'unique') {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|',
                ]);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|',
            ]);
        }


        if ($validator->fails()) {
            return $validator->errors()->first();
        }
    }
}
