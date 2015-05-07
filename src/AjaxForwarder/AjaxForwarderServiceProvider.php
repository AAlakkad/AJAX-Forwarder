<?php

namespace AAlakkad\AjaxForwarder;

use Illuminate\Support\ServiceProvider;

class AjaxForwarderServiceProvider extends ServiceProvider
{
    protected $configPath = __DIR__.'/../../config/';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            $this->configPath . 'forwarder.php' => config_path('forwarder.php'),
            ]);
        // include routes file
        include __DIR__.'/../../routes.php';
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            $this->configPath . 'forwarder.php', 'forwarder'
        );
    }
}
