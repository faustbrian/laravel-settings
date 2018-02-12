<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Settings.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Settings;

use BrianFaust\Cerealizer\Serialisers\JsonSerialiser;
use BrianFaust\Cerealizer\Serialisers\XmlSerialiser;
use BrianFaust\Cerealizer\Serialisers\YamlInlineSerialiser;
use BrianFaust\Cerealizer\Serialisers\YamlSerialiser;
use BrianFaust\Cerealizer\Unserialisers\JsonUnserialiser;
use BrianFaust\Cerealizer\Unserialisers\XmlUnserialiser;
use BrianFaust\Cerealizer\Unserialisers\YamlUnserialiser;
use BrianFaust\Settings\Store\DatabaseStore;
use BrianFaust\Settings\Store\JsonStore;
use BrianFaust\Settings\Store\MemoryStore;
use BrianFaust\Settings\Store\XmlStore;
use BrianFaust\Settings\Store\YamlInlineStore;
use BrianFaust\Settings\Store\YamlStore;
use Illuminate\Support\Manager;

class SettingsManager extends Manager
{
    public function getDefaultDriver()
    {
        return $this->getConfig('laravel-settings.store');
    }

    public function createJsonDriver()
    {
        $path = $this->getConfig('laravel-settings.path');

        return new JsonStore(
            $this->app['files'], new JsonSerialiser(), new JsonUnserialiser(), $path
        );
    }

    public function createXmlDriver()
    {
        $path = $this->getConfig('laravel-settings.path');

        return new XmlStore(
            $this->app['files'], new XmlSerialiser(), new XmlUnserialiser(), $path
        );
    }

    public function createYamlDriver()
    {
        $path = $this->getConfig('laravel-settings.path');

        return new YamlStore(
            $this->app['files'], new YamlSerialiser(), new YamlUnserialiser(), $path
        );
    }

    public function createYamlInlineDriver()
    {
        $path = $this->getConfig('laravel-settings.path');

        return new YamlInlineStore(
            $this->app['files'], new YamlInlineSerialiser(), new YamlUnserialiser(), $path
        );
    }

    public function createDatabaseDriver()
    {
        $connection = $this->app['db']->connection();
        $table = $this->getConfig('laravel-settings.table');

        return new DatabaseStore($connection, $table);
    }

    public function createMemoryDriver()
    {
        return new MemoryStore();
    }

    protected function getConfig($key)
    {
        return $this->app['config']->get($key);
    }
}
