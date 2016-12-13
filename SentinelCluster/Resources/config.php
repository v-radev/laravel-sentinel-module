<?php

use Monolog\Logger;

return [

    'module_name'                  => 'sentinelCluster',

    /*
    | The name of the namespace under which the SentinelCluster views are registered and accessed.
    */
    'views_name_space'             => 'sentinelCluster',

    /*
    | The name of the namespace under which the SentinelCluster routes are registered and accessed.
    */
    'routes_name_space'            => 'sentinelcluster',

    /*
    | The layout that the SentinelCluster templates extend.
    */
    'master_layout'                => 'layouts.master',

    /*
    | Enable or disable the login logging service.
    */
    'login_logging_enabled'        => false,

    /*
    | Enable or disable the route logging service.
    */
    'route_logging_enabled'         => false,

    /*
    | Enable or disable the route logging of the GET requests.
    */
    'ignore_route_log_get_requests' => true,

    /*
    | Route names that should be ignored from the route logging service.
    */
    'ignored_route_log_routes'      => [],

    /*
    | Channels that are available to be used with the Tell facade file logging.
    */
    'file_log_channels'             => [
        'payment' => [
            'path'    => 'logs/payments.log',
            'level'   => Logger::INFO,
            'default' => 'info',
        ],
        'deleting' => [
            'path'    => 'logs/deletes.log',
            'level'   => Logger::NOTICE,
            'default' => 'notice',
        ],
        'server' => [
            'path'    => 'logs/server_log.log',
            'level'   => Logger::ERROR,
            'default' => 'error',
        ]
    ],
];
