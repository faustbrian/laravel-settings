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

namespace Artisanry\Tests\Settings\Facades;

use Artisanry\Settings\Facades\Setting;
use Artisanry\Settings\SettingsManager;
use Artisanry\Tests\Settings\AbstractTestCase;
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
