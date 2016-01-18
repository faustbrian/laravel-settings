<?php

namespace DraperStudio\Settings\Contracts;

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
