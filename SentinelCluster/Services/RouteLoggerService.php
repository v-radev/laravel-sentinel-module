<?php

namespace App\Clusters\SentinelCluster\Services;

use App\Clusters\SentinelCluster\Models\UserRouteLog;
use Illuminate\Http\Request;

class RouteLoggerService extends LogServiceAbstract
{

    public static function log( Request $request )
    {
        $serviceEnabled = config('sentinel.route_logging_enabled');
        $ignoreGetRequests = config('sentinel.ignore_route_log_get_requests');
        $ignoredRoutes = config('sentinel.ignored_route_log_routes');
        $isGetRequest = strtolower($request->method()) == 'get';
        $routeName = $request->route()->getName();
        $self = new static;

        if ( !$serviceEnabled ) {
            return $self;
        }

        if ( $ignoreGetRequests && $isGetRequest ) {
            return $self;
        }

        if ( in_array($routeName, $ignoredRoutes) ) {
            return $self;
        }

        $requestData = [
            'ip'         => $self->getIP(),
            'user_id'    => \Auth::id(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'method'     => $request->method(),
            'url'        => $request->fullUrl(),
            'route_name' => $routeName,
        ];

        UserRouteLog::create($requestData);

        return $self;
    }
}
