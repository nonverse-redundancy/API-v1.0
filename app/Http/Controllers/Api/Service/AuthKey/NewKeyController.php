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
        $usernamecased = false;
        if ($mcuuid) {
            $official = true;
            $usernamecased = $mcuuid['name'];
        }
        $response = array(
            "official" => $official,
            "name" => $usernamecased,
        );

        return response($response, 200);
    }
}