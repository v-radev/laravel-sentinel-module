<?php

namespace App\Clusters\SentinelCluster\Providers;

use App\Clusters\SentinelCluster\Services\LoginLoggerService;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dispatcher $events
     */
    public function boot( Dispatcher $events )
    {
        $this->bootUserEventListeners($events);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function bootUserEventListeners( Dispatcher $events )
    {
        $events->listen(Login::class, function ($loginEvent) {
            LoginLoggerService::login($loginEvent->user)->log();
        });

        $events->listen(Logout::class, function ($logoutEvent) {
            LoginLoggerService::logout($logoutEvent->user)->log();
        });
    }
}
