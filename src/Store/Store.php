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

namespace BrianFaust\Settings\Store;

use BrianFaust\Settings\Contracts\Store as StoreContract;

abstract class Store implements StoreContract
{
    protected $storage = [];

    protected $modified = false;

    protected $loaded = false;

    public function all()
    {
        $this->checkLoaded();

        return $this->storage;
    }

    public function has($key)
    {
        $this->checkLoaded();

        return !is_null($this->get($key));
    }

    public function get($key)
    {
        $this->checkLoaded();

        if (array_key_exists($key, $this->storage)) {
            return $this->storage[$key];
        }
    }

    public function put($key, $value = null)
    {
        $this->checkLoaded();
        $this->modified = true;

        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->put($k, $v);
            }
        } else {
            $this->storage[$key] = $value;
        }
    }

    public function forget($key)
    {
        $this->modified = true;

        if ($this->has($key)) {
            unset($this->storage[$key]);
        }

        return true;
    }

    public function flush()
    {
        $this->storage = [];
        $this->modified = true;
    }

    public function save()
    {
        if (!$this->modified) {
            return;
        }

        $this->write($this->storage);
        $this->modified = false;
    }

    private function checkLoaded()
    {
        if (!$this->modified) {
            $this->storage = json_decode(json_encode($this->read()), true);
            $this->modified = true;
        }
    }

    abstract protected function read();

    abstract protected function write(array $storage);
}
