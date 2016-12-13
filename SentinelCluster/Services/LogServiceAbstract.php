<?php

namespace App\Clusters\SentinelCluster\Services;

abstract class LogServiceAbstract
{
    protected function getIP()
    {
        $serverValues = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];

        foreach ( $serverValues as $serverValue ) {
            if ( array_key_exists($serverValue, $_SERVER) === true ) {
                return trim($_SERVER[$serverValue]);
            }
        }

        return '127.0.0.1';
    }
}
