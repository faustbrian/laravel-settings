<?php

/*
 * This file is part of Laravel Settings.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Settings\Contracts;

interface Store
{
    public function all();

    public function has($key);

    public function get($key);

    public function put($key, $value);

    public function forget($key);

    public function flush();

    public function save();
}
