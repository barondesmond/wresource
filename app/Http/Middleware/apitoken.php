<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class apitoken
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
        if ( $request->bearerToken() && $request->bearerToken() ==  hash('sha256', env('TOKEN'))) {
            return $next($request);
        }
    return response('Unauthorized.' . $request->bearerToken() . ':' . hash('sha256', env('TOKEN')), 401);
    }

}
