<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;

class VerifyOwnership
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
        if ($request->uuid !== $request->route('id')) {
            return abort(401);
        }
        return $next($request);
    }
}
