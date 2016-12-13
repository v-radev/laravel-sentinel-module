<?php

namespace App\Clusters\SentinelCluster\Models;

use App\Clusters\MainCluster\Models\MasterModel;

class UserRouteLog extends MasterModel
{

    protected $fillable = [
        'ip',
        'method',
        'route_name',
        'url',
        'user_id',
        'user_agent',
    ];


    public function user()
    {
        return $this->belongsTo('App\Clusters\AuthCluster\Models\User');
    }
}
