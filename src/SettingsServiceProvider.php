<?php

/*
 * This file is part of Laravel Settings.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BrianFaust\Settings;

use BrianFaust\ServiceProvider\AbstractServiceProvider;

class SettingsServiceProvider extends AbstractServiceProvider
{
    public function boot(): void
    {
        $this->publishMigrations();

        $this->publishConfig();
    }

    public function register(): void
    {
        parent::register();

        $this->mergeConfig();

        $this->app->singleton('settings-manager', function ($app) {
            return new SettingsManager($app);
        });
    }

    public function provides(): array
    {
        return array_merge(parent::provides(), ['settings-manager']);
    }

    public function getPackageName(): string
    {
        return 'settings';
    }
}
