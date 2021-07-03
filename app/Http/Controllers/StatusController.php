<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StatusController extends Controller
{
    function display() {

        $connected = false;
        $status = 'ERROR';
        $deployment = '';

        if (DB::connection()->getDatabaseName('mysql')) {
            $connected = true;
        } else {
            //
        }

        if ($connected) {
            $status = 'OK';
        } else {
            //
        }

        if (env('APP_DEBUG')) {
            $deployment = 'Development';
        } else {
            $deployment = 'Production';
        }

        $out = array(
            'Status' => $status,
            'Deployment' => $deployment,
            'App-Description' => 'Nonverse Application Programming Interface (API)',
            'Author' => env('APP_AUTHOR'),
        );

        return $out;
    }
}
