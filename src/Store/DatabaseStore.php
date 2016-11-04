<?php

namespace BrianFaust\Settings\Store;

use Illuminate\Database\Connection;

class DatabaseStore extends Store
{
    protected $connection;

    protected $table;

    protected $queryConstraint;

    protected $extraColumns = [];

    public function __construct(Connection $connection, $table)
    {
        $this->connection = $connection;
        $this->table = $table;
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function setConstraint(\Closure $callback)
    {
        $this->data = [];
        $this->loaded = false;
        $this->queryConstraint = $callback;
    }

    public function setExtraColumns(array $columns)
    {
        $this->extraColumns = $columns;
    }

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

    protected function read()
    {
        return $this->parseReadData($this->newQuery()->get());
    }

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
