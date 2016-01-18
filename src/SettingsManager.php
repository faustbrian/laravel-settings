<?php

namespace DraperStudio\Settings;

use DraperStudio\Cerealizer\Serialisers\JsonSerialiser;
use DraperStudio\Cerealizer\Serialisers\XmlSerialiser;
use DraperStudio\Cerealizer\Serialisers\YamlInlineSerialiser;
use DraperStudio\Cerealizer\Serialisers\YamlSerialiser;
use DraperStudio\Cerealizer\Unserialisers\JsonUnserialiser;
use DraperStudio\Cerealizer\Unserialisers\XmlUnserialiser;
use DraperStudio\Cerealizer\Unserialisers\YamlUnserialiser;
use DraperStudio\Settings\Store\DatabaseStore;
use DraperStudio\Settings\Store\JsonStore;
use DraperStudio\Settings\Store\MemoryStore;
use DraperStudio\Settings\Store\XmlStore;
use DraperStudio\Settings\Store\YamlInlineStore;
use DraperStudio\Settings\Store\YamlStore;
use Illuminate\Support\Manager;

class SettingsManager extends Manager
{
    public function getDefaultDriver()
    {
        return $this->getConfig('settings.store');
    }

    public function createJsonDriver()
    {
        $path = $this->getConfig('settings.path');

        return new JsonStore(
            $this->app['files'], new JsonSerialiser(), new JsonUnserialiser(), $path
        );
    }

    public function createXmlDriver()
    {
        $path = $this->getConfig('settings.path');

        return new XmlStore(
            $this->app['files'], new XmlSerialiser(), new XmlUnserialiser(), $path
        );
    }

    public function createYamlDriver()
    {
        $path = $this->getConfig('settings.path');

        return new YamlStore(
            $this->app['files'], new YamlSerialiser(), new YamlUnserialiser(), $path
        );
    }

    public function createYamlInlineDriver()
    {
        $path = $this->getConfig('settings.path');

        return new YamlInlineStore(
            $this->app['files'], new YamlInlineSerialiser(), new YamlUnserialiser(), $path
        );
    }

    public function createDatabaseDriver()
    {
        $connection = $this->app['db']->connection();
        $table = $this->getConfig('settings.table');

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
