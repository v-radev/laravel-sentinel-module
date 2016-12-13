<?php

namespace App\Clusters\SentinelCluster\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom( realpath( base_path('app/Clusters/SentinelCluster/Resources/views') ), config('sentinel.module_name') );

        $this->loadGlobalVariables();
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

    protected function loadGlobalVariables()
    {
        $moduleViewsNamespace = $this->getModuleViewsNamespace();
        $moduleRoutesNamespace = config('sentinel.routes_name_space') . '.';

        // Globals
        view()->composer($moduleViewsNamespace . '*', function ($view) use ($moduleViewsNamespace, $moduleRoutesNamespace) {
            $view->with('sentinelClusterViews', $moduleViewsNamespace);
            $view->with('sentinelClusterRoutes', $moduleRoutesNamespace);
            $view->with('sentinelClusterLayout', config('sentinel.master_layout'));
        });
    }

    protected function getModuleViewsNamespace()
    {
        return config('sentinel.views_name_space') . '::';
    }
}
