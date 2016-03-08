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

use Illuminate\Database\Connection;

/**
 * Class DatabaseStore.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class DatabaseStore extends Store
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var
     */
    protected $table;

    /**
     * @var
     */
    protected $queryConstraint;

    /**
     * @var array
     */
    protected $extraColumns = [];

    /**
     * DatabaseStore constructor.
     *
     * @param Connection $connection
     * @param $table
     */
    public function __construct(Connection $connection, $table)
    {
        $this->connection = $connection;
        $this->table = $table;
    }

    /**
     * @param $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @param \Closure $callback
     */
    public function setConstraint(\Closure $callback)
    {
        $this->data = [];
        $this->loaded = false;
        $this->queryConstraint = $callback;
    }

    /**
     * @param array $columns
     */
    public function setExtraColumns(array $columns)
    {
        $this->extraColumns = $columns;
    }

    /**
     * @param $key
     */
    public function forget($key)
    {
        parent::forget($key);

        // because the database store cannot store empty arrays, remove empty
        // arrays to keep data consistent before and after saving
        $segments = explode('.', $key);
        array_pop($segments);

        while ($segments) {
            $segment = implode('.', $segments);

            // non-empty array - exit out of the loop
            if ($this->get($segment)) {
                break;
            }

            // remove the empty array and move on to the next segment
            $this->forget($segment);
            array_pop($segments);
        }
    }

    /**
     * @param array $data
     */
    protected function write(array $data)
    {
        $keys = $this->newQuery()->lists('key');

        $insertData = array_dot($data);
        $updateData = [];
        $deleteKeys = [];

        foreach ($keys as $key) {
            if (isset($insertData[$key])) {
                $updateData[$key] = $insertData[$key];
            } else {
                $deleteKeys[] = $key;
            }

            unset($insertData[$key]);
        }

        foreach ($updateData as $key => $value) {
            $this->newQuery()
                ->where('key', '=', $key)
                ->update(['value' => $value]);
        }

        if ($insertData) {
            $this->newQuery(true)
                ->insert($this->prepareInsertData($insertData));
        }

        if ($deleteKeys) {
            $this->newQuery()
                ->whereIn('key', $deleteKeys)
                ->delete();
        }
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function prepareInsertData(array $data)
    {
        $dbData = [];

        if ($this->extraColumns) {
            foreach ($data as $key => $value) {
                $dbData[] = array_merge(
                    $this->extraColumns, ['key' => $key, 'value' => $value]
                );
            }
        } else {
            foreach ($data as $key => $value) {
                $dbData[] = ['key' => $key, 'value' => $value];
            }
        }

        return $dbData;
    }

    /**
     * @return array
     */
    protected function read()
    {
        return $this->parseReadData($this->newQuery()->get());
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function parseReadData($data)
    {
        $results = [];

        foreach ($data as $row) {
            if (is_array($row)) {
                $key = $row['key'];
                $value = $row['value'];
            } elseif (is_object($row)) {
                $key = $row->key;
                $value = $row->value;
            } else {
                $msg = 'Expected array or object, got '.gettype($row);
                throw new \UnexpectedValueException($msg);
            }

            array_set($results, $key, $value);
        }

        return $results;
    }

    /**
     * @param bool $insert
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newQuery($insert = false)
    {
        $query = $this->connection->table($this->table);

        if (!$insert) {
            foreach ($this->extraColumns as $key => $value) {
                $query->where($key, '=', $value);
            }
        }

        if ($this->queryConstraint !== null) {
            $callback = $this->queryConstraint;
            $callback($query, $insert);
        }

        return $query;
    }
}
