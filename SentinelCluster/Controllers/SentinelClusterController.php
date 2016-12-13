<?php

namespace App\Clusters\SentinelCluster\Controllers;

use App\Clusters\MainCluster\Controllers\MasterController;

abstract class SentinelClusterController extends MasterController
{

    public $views = 'sentinelCluster::';

    public $clusterRoutes = '';


    public function __construct()
    {
        parent::__construct();

        $this->clusterRoutes = config('sentinel.routes_name_space') . '.';
    }


    public function view( $name, $data = [] )
    {
        return view($this->views . $name, $data);
    }
}
