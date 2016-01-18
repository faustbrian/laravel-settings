<?php

namespace DraperStudio\Settings;

use DraperStudio\ServiceProvider\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    protected $packageName = 'settings';

    public function boot()
    {
        $this->setup(__DIR__)
             ->publishMigrations()
             ->publishConfig()
             ->mergeConfig('settings');
    }

    public function register()
    {
        $this->app->singleton(SettingsManager::class, function ($app) {
            return new SettingsManager($app);
        });
    }
}
