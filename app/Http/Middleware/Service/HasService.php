<?php

namespace App\Http\Middleware\Service;

use App\Models\Service;
use Closure;
use Illuminate\Http\Request;

class HasService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $service)
    {
        $user = $request->user();
        $serviceid = $service . '.service';

        $userservicelist = Service::where('uuid', $user->uuid)->get();
        $has = $userservicelist->whereIn('service_id', $serviceid);

        if ($has->isEmpty()) {
            abort(401);
        }

        return $next($request);
    }
}
