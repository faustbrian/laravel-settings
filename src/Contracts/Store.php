<?php

/*
 * This file is part of Laravel Settings.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Settings\Contracts;

/**
 * Interface Store.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
interface Store
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $key
     *
     * @return mixed
     */
    public function has($key);

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function put($key, $value);

    /**
     * @param $key
     *
     * @return mixed
     */
    public function forget($key);

    /**
     * @return mixed
     */
    public function flush();

    /**
     * @return mixed
     */
    public function save();
}
