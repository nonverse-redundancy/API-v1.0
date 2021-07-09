<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerifyOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $access)
    {
        
        if ($access === 'withadmin') {
            if (!Auth::user()->admin && (Auth::user()->uuid !== $request->route('id'))) {
                return abort(401);
            }
        }
        if ($access === 'noadmin') {
            if (Auth::user()->uuid !== $request->route('id')) {
                return abort(401);
            }
        }

        return $next($request);
    }
}
