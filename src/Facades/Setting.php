<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Settings.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Settings\Facades;

use Illuminate\Support\Facades\Facade;

class Setting extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'settings-manager';
    }
}
