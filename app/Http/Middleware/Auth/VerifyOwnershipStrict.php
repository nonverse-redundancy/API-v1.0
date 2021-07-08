<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyOwnershipStrict
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
        if (User::where('uuid', $request->session()->get('auth'))->exists()) {
            $user = User::where('uuid', $request->session()->get('auth'))->first();
            if ($request->session()->get('auth') === $request->route('id')) {
                return $next($request);
            }
            return abort(401);
        }
    }
}
