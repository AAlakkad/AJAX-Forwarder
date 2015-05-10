<?php

namespace AAlakkad\AjaxForwarder;

use Illuminate\Support\ServiceProvider;

class AjaxForwarderServiceProvider extends ServiceProvider
{
    protected $configPath = __DIR__ . '/../../config/';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            $this->configPath . 'forwarder.php' => config_path('forwarder.php'),
        ]);
        // include routes file
        include $this->configPath . 'routes.php';
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Add binding for Api Repository
        $this->app->bind('AAlakkad\AjaxForwarder\Repositories\ApiRepository', 'AAlakkad\AjaxForwarder\Repositories\ApiGuzzle');

        $this->mergeConfigFrom(
            $this->configPath . 'forwarder.php', 'forwarder'
        );
    }
}
