<?php



declare(strict_types=1);



namespace BrianFaust\Tests\Settings\Facades;

use BrianFaust\Settings\Facades\Setting;
use BrianFaust\Settings\SettingsManager;
use BrianFaust\Tests\Settings\AbstractTestCase;
use GrahamCampbell\TestBenchCore\FacadeTrait;

class FacadeTest extends AbstractTestCase
{
    use FacadeTrait;

    protected function getFacadeAccessor()
    {
        return 'settings-manager';
    }

    protected function getFacadeClass()
    {
        return Setting::class;
    }

    protected function getFacadeRoot()
    {
        return SettingsManager::class;
    }
}
