<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerifyAdmin
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
        if (Auth::user()->admin) {
            return $next($request);
        }
        abort(401);
    }
}
