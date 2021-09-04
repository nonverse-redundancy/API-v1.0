<?php

namespace App\Http\Controllers\api\service\authkey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service\AuthKey;
use App\Models\Service\Service;
use Illuminate\Support\Facades\Hash;

class AuthKeyController extends Controller
{
    function verify(Request $request) {

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
    
    function store(Request $request) {
        
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
    
    public function show(Request $request) {
        $user = $request->user();
        $service = Service::where('uuid', $user->uuid)->get()->whereIn('service_id', 'authme.service')->first();
        $keystats = AuthKey::where('realname', $service->service_user)->first();

        return json_encode($keystats, JSON_PRETTY_PRINT);
    }
}