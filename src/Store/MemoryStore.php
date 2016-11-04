<?php

namespace BrianFaust\Settings\Store;

class MemoryStore extends Store
{
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    protected function read()
    {
        return $this->data;
    }

    protected function write(array $data)
    {
    }
}
