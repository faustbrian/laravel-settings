<?php

namespace BrianFaust\Settings;

class ServiceProvider extends \BrianFaust\ServiceProvider\ServiceProvider
{
    public function boot()
    {
        $this->publishMigrations();

        $this->publishConfig();
    }

    public function register()
    {
        parent::register();

        $this->mergeConfig();

        // $this->app->singleton(SettingsManager::class, function ($app) {
        $this->app->singleton('settings-manager', function ($app) {
            return new SettingsManager($app);
        });
    }

    public function provides()
    {
        return array_merge(parent::provides(), ['settings-manager']);
    }

    public function getPackageName()
    {
        return 'settings';
    }
}
