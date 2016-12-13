<?php

namespace App\Clusters\SentinelCluster\Models;

use App\Clusters\MainCluster\Models\MasterModel;

class UserLoginLog extends MasterModel
{

    protected $fillable = [
        'ip',
        'type',
        'user_id',
        'user_agent',
    ];


    public function user()
    {
        return $this->belongsTo('App\Clusters\AuthCluster\Models\User');
    }
}
