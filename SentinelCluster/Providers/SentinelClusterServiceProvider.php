<?php

namespace App\Clusters\SentinelCluster\Providers;

use App\Clusters\SentinelCluster\Commands\CleanUserLoginLogs;
use App\Clusters\SentinelCluster\Commands\CleanVisitedRouteLogs;
use App\Clusters\SentinelCluster\Services\FileLoggingService;
use Illuminate\Support\ServiceProvider;

class SentinelClusterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes( [
            realpath( base_path('app/Clusters/SentinelCluster/Resources/config.php') ) => config_path('sentinel.php'),
        ], 'sentinel' );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register( RouteServiceProvider::class );
        $this->app->register( ViewServiceProvider::class );
        $this->app->register( EventServiceProvider::class );
        $this->registerCleanLogsCommands();

        // Bind logger instance for facade Tell
        $this->app->bind('file.logging.service', FileLoggingService::class);
    }

    private function registerCleanLogsCommands()
    {
        $this->app->singleton('CleanUserLoginLogsCommand', function () {
            return new CleanUserLoginLogs;
        });

        $this->app->singleton('CleanVisitedRouteLogs', function () {
            return new CleanVisitedRouteLogs;
        });

        $this->commands('CleanUserLoginLogsCommand');
        $this->commands('CleanVisitedRouteLogs');
    }
}
