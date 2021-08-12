<?php

namespace App\Http\Controllers\api\service\authkey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuthKey;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;

class NewKeyController extends Controller
{
    function username(Request $request) {

        $request->validate([
            'username' => 'required|unique:services.authme',
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
    
    function generate(Request $request) {
        
        $request->validate([
            'username' => 'required',
            'password' => 'min:8|confirmed',
        ]);

        $user = $request->user();
        $service = new Service();
        $key = new AuthKey();
        $mcservice = Service::where('uuid', $user->uuid)->get()->whereIn('service_id', 'mc-java.service')->first();
        
        $service->uuid = $user->uuid;
        $service->service_id = "authme.service";
        $service->service_active = 1;
        $service->service_user = $request->username;
        $query1 = $service->save();

        $mcservice->service_user = $request->username;
        $query2 = $mcservice->save();

        //$key->uuid = $user->uuid;
        $key->username = strtolower($request->username);
        $key->realname = $request->username;
        $key->password = Hash::make($request->password);
        $key->regdate = round(microtime(true) * 1000);
        $key->regip = $_SERVER['REMOTE_ADDR'];
        $key->email = $user->email;
        $query3 = $key->save();
    }
}