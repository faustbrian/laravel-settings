<?php



declare(strict_types=1);



namespace BrianFaust\Settings\Facades;

use Illuminate\Support\Facades\Facade;

class Setting extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'settings-manager';
    }
}
