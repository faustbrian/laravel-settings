<?php

/*
 * This file is part of Laravel Settings.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Settings\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Setting.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class Setting extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return 'settings-manager';
    }
}
