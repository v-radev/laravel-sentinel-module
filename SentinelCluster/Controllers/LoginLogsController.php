<?php

namespace App\Clusters\SentinelCluster\Controllers;

use App\Clusters\SentinelCluster\Models\UserLoginLog;

class LoginLogsController extends SentinelClusterController
{

    public function index()
    {
        $logs = UserLoginLog::with('user')->orderBy('created_at', 'DESC')->paginate(50);

        return $this->view('user_logs.index', compact('logs'));
    }
}
