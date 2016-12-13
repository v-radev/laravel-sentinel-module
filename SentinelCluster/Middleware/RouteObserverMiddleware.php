<?php

namespace App\Clusters\SentinelCluster\Middleware;

use App\Clusters\SentinelCluster\Services\RouteLoggerService;
use Closure;

class RouteObserverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        RouteLoggerService::log($request);

        return $next($request);
    }
}
