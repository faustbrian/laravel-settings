<?php

namespace DraperStudio\Settings\Facades;

use DraperStudio\Settings\SettingsManager;
use Illuminate\Support\Facades\Facade;

class Setting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SettingsManager::class;
    }
}
