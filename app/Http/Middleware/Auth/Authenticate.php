<?php

namespace App\Http\Middleware\Auth;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $opts = false;
        try {
            $opts = array('http' => array('header' => 'Cookie: ' . $_SERVER['HTTP_COOKIE'] . "\r\n"));
        } catch (Exception $e) {
            return redirect($request->url());
        }
        $context = stream_context_create($opts);

        $location = env('AUTH_LOCATION') . '/session/user/current';
        $continue = parse_url($request->url(), PHP_URL_HOST);
        $resource = substr(parse_url($request->url(), PHP_URL_PATH), 1);

        try {
            $auth = json_decode(file_get_contents($location, false, $context), true);
            if (User::where('uuid', $auth['uuid'])->exists()) {
                $user = User::where('uuid', $auth['uuid'])->first();
                Auth::loginUsingId($user->id);
            }
            $request->session()->regenerateToken();
        } catch (Exception $e) {
            return redirect(env('AUTH_LOCATION') . '/login?continue=' . $continue . '&resource=' . $resource);
        }
        return $next($request);
    }

    public function terminate(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
