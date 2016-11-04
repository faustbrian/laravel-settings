<?php

namespace BrianFaust\Tests\Settings\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use BrianFaust\Tests\Settings\AbstractTestCase;
use BrianFaust\Settings\Facades\Setting;
use BrianFaust\Settings\SettingsManager;

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
