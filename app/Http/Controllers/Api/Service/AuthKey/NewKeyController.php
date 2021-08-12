<?php

namespace App\Http\Controllers\api\service\authkey;

use App\Http\Controllers\Controller;
use App\Models\AuthKey;
use Illuminate\Http\Request;

class NewKeyController extends Controller
{
    function username(Request $request) {

        $request->validate([
            'username' => 'required',
        ]);

        $mojanguuidurl = 'https://api.mojang.com/users/profiles/minecraft/' . $request->username;
        $mcuuid = json_decode(file_get_contents($mojanguuidurl), true);
        $official = false;

        if ($mcuuid) {
            $official = true;

        }
        $response = array(
            "official" => $official,
        );

        return response($response, 200);
    }
}