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

/**
 * Class MemoryStore.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class MemoryStore extends Store
{
    /**
     * MemoryStore constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    protected function read()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    protected function write(array $data)
    {
        //
    }
}
