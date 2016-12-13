<?php

namespace App\Clusters\SentinelCluster\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Log\Writer
 */
class Tell extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'file.logging.service';
    }
}
