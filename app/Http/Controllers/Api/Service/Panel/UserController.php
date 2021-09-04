<?php

namespace App\Http\Controllers\Api\Service\Panel;

use App\Http\Controllers\Controller;
use App\Models\Service\Panel\PanelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    function create(Request $request) {
        $user = $request->user();
        $url = env('PANEL_LOCATION') . '/api/application/users';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);

        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer " . env('PANEL_TOKEN_USER'),
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        $payload = json_encode(array(
            'email' => $user->email,
            'username' => $user->username,
            'first_name' => $user->name_first,
            'last_name' => $user->name_last,
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

        curl_exec($curl);
        if (curl_errno($curl)) {
            $e = curl_error($curl);
        }
        curl_close($curl);

        if (isset($e)) {
            abort(424);
        }

        $paneluser = PanelUser::where('email', $user->email)->first();

    }
}
