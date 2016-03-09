<?php

/*
 * This file is part of Laravel Settings.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Settings\Store;

use DraperStudio\Settings\Contracts\Store as StoreContract;

/**
 * Class Store.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
abstract class Store implements StoreContract
{
    /**
     * @var array
     */
    protected $storage = [];

    /**
     * @var bool
     */
    protected $modified = false;

    /**
     * @var bool
     */
    protected $loaded = false;

    /**
     * @return array
     */
    public function all()
    {
        $this->checkLoaded();

        return $this->storage;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function has($key)
    {
        $this->checkLoaded();

        return !is_null($this->get($key));
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        $this->checkLoaded();

        if (array_key_exists($key, $this->storage)) {
            return $this->storage[$key];
        }
    }

    /**
     * @param $key
     * @param null $value
     */
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

    /**
     * @param $key
     *
     * @return bool
     */
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

    /**
     * @return mixed
     */
    abstract protected function read();

    /**
     * @param array $storage
     *
     * @return mixed
     */
    abstract protected function write(array $storage);
}
