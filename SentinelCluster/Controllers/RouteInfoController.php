<?php

namespace App\Clusters\SentinelCluster\Controllers;

use Illuminate\Routing\Router;

class RouteInfoController extends SentinelClusterController
{

    public function index( Router $router )
    {
        $routesCollection = $router->getRoutes();
        $routes = $routesCollection->getRoutes();
        $routesInfo = [];
        $infoMethods = [
            'Methods', 'Name', 'Path', 'Prefix', 'ActionName'
        ];

        foreach ( $routes as $route ) {
            $unique = uniqid();

            foreach ( $infoMethods as $method ) {
                $methodName = 'get' . $method;
                $keyName = strtolower($method);
                $routesInfo[$unique][$keyName] = $route->$methodName();
            }

            $routesInfo[$unique]['middleware'] = $route->middleware();
        }


        return $this->view('routes_info.index', compact('routesInfo'));
    }
}
