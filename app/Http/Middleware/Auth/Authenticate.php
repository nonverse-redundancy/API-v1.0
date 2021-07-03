<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Exception;

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
        $opts = array('http' => array('header' => 'Cookie: ' . $_SERVER['HTTP_COOKIE'] . "\r\n"));
        $context = stream_context_create($opts);

        $location = env('AUTH_LOCATION') . '/api/user/logged';
        $continue = parse_url($request->url(), PHP_URL_HOST);
        $resource = substr(parse_url($request->url(), PHP_URL_PATH), 1);

        try {
            $auth = json_decode(file_get_contents($location, false, $context), true);
            $request->request->add(['uuid' => $auth['uuid']]);
        } catch (Exception $e) {
            return redirect(env('AUTH_LOCATION') . '/login?continue=' . $continue . '&resource=' . $resource);
        }
        return $next($request);
    }
}
