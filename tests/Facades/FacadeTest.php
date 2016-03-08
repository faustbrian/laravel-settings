<?php

/*
 * This file is part of Laravel Settings.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Tests\Settings\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use DraperStudio\Tests\Settings\AbstractTestCase;
use DraperStudio\Settings\Facades\Setting;
use DraperStudio\Settings\SettingsManager;

/**
 * This is the facade test class.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class FacadeTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'settings-manager';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Setting::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return SettingsManager::class;
    }
}
