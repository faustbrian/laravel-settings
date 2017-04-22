<?php



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
