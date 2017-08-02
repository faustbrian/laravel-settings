<?php

/*
 * This file is part of Laravel Settings.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Settings\Facades;

use Illuminate\Support\Facades\Facade;

class Setting extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'settings-manager';
    }
}
