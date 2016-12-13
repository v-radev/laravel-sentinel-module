<?php

$moduleRoutesNamespace = config('sentinel.routes_name_space') . '.';

Route::pattern('id', '[1-9][0-9]*');

Route::group( [ 'prefix' => 'dashboard', 'middleware' => [ 'web', 'auth' ] ], function () use ($moduleRoutesNamespace) {
    Route::get('loginlogs', [
        'as'         => $moduleRoutesNamespace . 'loginlogs.index',
        'uses'       => 'App\Clusters\SentinelCluster\Controllers\LoginLogsController@index',
    ]);

    Route::get('routelogs', [
        'as'         => $moduleRoutesNamespace . 'routelogs.index',
        'uses'       => 'App\Clusters\SentinelCluster\Controllers\RouteLogsController@index',
    ]);

    Route::get('routesinfo', [
        'as'         => $moduleRoutesNamespace . 'routesinfo.index',
        'uses'       => 'App\Clusters\SentinelCluster\Controllers\RouteInfoController@index',
    ]);

    Route::get('filelogs', [
        'as'         => $moduleRoutesNamespace . 'filelogs.index',
        'uses'       => 'App\Clusters\SentinelCluster\Controllers\FileLogsController@index',
    ]);
} );
