<?php

/*
 * This file is part of Laravel Settings.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Settings;

use BrianFaust\ServiceProvider\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
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
