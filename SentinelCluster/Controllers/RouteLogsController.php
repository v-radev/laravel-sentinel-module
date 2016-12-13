<?php

namespace App\Clusters\SentinelCluster\Controllers;

use App\Clusters\SentinelCluster\Models\UserRouteLog;

class RouteLogsController extends SentinelClusterController
{

    public function index()
    {
        $logs = UserRouteLog::with('user')->orderBy('created_at', 'DESC')->paginate(50);

        return $this->view('user_routes.index', compact('logs'));
    }
}
