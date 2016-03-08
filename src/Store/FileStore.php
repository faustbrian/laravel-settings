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

use Illuminate\Filesystem\Filesystem;
use DraperStudio\Cerealizer\Contracts\Serialiser;
use DraperStudio\Cerealizer\Contracts\Unserialiser;

/**
 * Class FileStore.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
abstract class FileStore extends Store
{
    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @var Serialiser
     */
    private $serialiser;

    /**
     * @var Unserialiser
     */
    private $unserialiser;

    /**
     * FileStore constructor.
     *
     * @param Filesystem   $files
     * @param Serialiser   $serialiser
     * @param Unserialiser $unserialiser
     * @param $path
     */
    public function __construct(Filesystem $files, Serialiser $serialiser, Unserialiser $unserialiser, $path)
    {
        $this->files = $files;
        $this->serialiser = $serialiser;
        $this->unserialiser = $unserialiser;
        $this->setPath($path);
    }

    /**
     * @return mixed
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function read()
    {
        return $this->unserialiser->unserialise($this->files->get($this->path));
    }

    /**
     * @param array $data
     *
     * @return int
     */
    protected function write(array $data)
    {
        return $this->files->put($this->path, $this->serialiser->serialise($data));
    }

    /**
     * @param $path
     *
     * @throws NotWriteableException
     */
    private function setPath($path)
    {
        if (!$this->files->exists($path)) {
            $result = $this->files->put($path, '');

            if ($result === false) {
                throw new NotWriteableException("Could not write to $path.");
            }
        }

        if (!$this->files->isWritable($path)) {
            throw new NotWriteableException("$path is not writable.");
        }

        $this->path = $path;
    }
}
