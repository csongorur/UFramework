<?php

namespace Core;

use Config\Database;

/**
 * Base model
 */
abstract class Model
{
    protected $table;
    protected $connection;
    protected $fillable;

    public function __construct()
    {
        // connect to the db
        $this->connection = new \mysqli(Database::$host, Database::$username, Database::$password, Database::$database);
        $this->connection->set_charset('utf8');
    }
    
    /**
     * Close the database connection.
     */
    public function __destruct()
    {
        $this->connection->close();
    }

    /**
     * Escape sql strings.
     * @param  string $string
     * @return string
     */
    private function escape(string $string)
    {
        return $this->connection->real_escape_string($string);
    }

    /**
     * Get the tabe name escaped.
     * @return string
     */
    private function getTable()
    {
        return $this->escape($this->table);
    }

    /**
     * Create result array.
     * @param  array $result
     * @return array
     */
    private function createResultArray($result)
    {
        $response_array = [];

        while ($row = $result->fetch_assoc()) {
            foreach ($this->fillable as $item) {
                $result_array[$item] = $row[$item];
            }

            $response_array[] = $result_array;

        }

        return $response_array;
    }

    /**
     * Throw exception when data array is empty.
     * @param  array|null $data
     */
    private function checkData(array $data = null)
    {
        if (is_null($data)) {
            throw new \Exception("Data array is empty", 1);

        }
    }

    /**
     * Throw exception when id is empty.
     * @param  string $id
     */
    private function checkString(string $id = '')
    {
        if ($id == '') {
            throw new \Exception("Param is empty", 1);
        }
    }

    /**
     * Get all records.
     * @return array
     */
    public function all()
    {
        $query = sprintf('SELECT * FROM %s', $this->getTable());

        $result = $this->connection->query($query);

        return $this->createResultArray($result);
    }

    /**
     * Get a specified record.
     * @param  string    $id
     * @return array
     */
    public function find(string $id)
    {
        $query = sprintf('SELECT * FROM %s WHERE ID = %s LIMIT 1', $this->getTable(), $this->escape($id));

        $result = $this->connection->query($query);

        return $this->createResultArray($result)[0];
    }

    /**
     * Get a specified record with where.
     * @param  string $col
     * @param  string $op
     * @param  string $data
     * @return array
     */
    public function where(string $col = '', string $op = '=', string $data = '')
    {
        $this->checkString($col);
        $this->checkString($op);
        $this->checkString($data);

        $col = $this->escape($col);
        $op = $this->escape($op);
        $data = $this->escape($data);
        $data = "'$data'";

        $query = sprintf('SELECT * FROM %s WHERE %s %s %s', $this->getTable(), $col, $op, $data);

        $result = $this->connection->query($query);

        return $this->createResultArray($result);
    }

    /**
     * Create a record.
     * @param  array  $data
     * @return array
     */
    public function create(array $data = null)
    {
        $this->checkData($data);

        $col = '';
        $values = '';

        foreach ($data as $key => $item) {
            $col_item = $this->escape($key);
            $val_item = $this->escape($item);

            $col .= $col_item . ',';
            $values .= "'$val_item',";
        }

        $col = preg_replace('/,$/', '', $col);
        $values = preg_replace('/,$/', '', $values);

        $query = sprintf('INSERT INTO %s (%s) VALUES (%s)', $this->getTable(), $col, $values);

        $result = $this->connection->query($query);

        if (!$result) {
            throw new \Exception("Creation not was success!", 1);
        }

        $query = sprintf('SELECT * FROM %s ORDER BY ID DESC LIMIT 1', $this->getTable());
        $res = $this->connection->query($query);

        return $this->createResultArray($res);
    }

    /**
     * Update a specified record.
     * @param  string     $id
     * @param  array|null $data
     * @return array
     */
    public function update(string $id = '', array $data = null)
    {
        $this->checkString($id);
        $this->checkData($data);

        $values = '';

        foreach ($data as $key => $item) {
            $key = $this->escape($key);
            $item = $this->escape($item);
            $values .= $key . ' = ' . "'$item',";
        }

        $values = preg_replace('/,$/', '', $values);

        $query = sprintf('UPDATE %s SET %s WHERE ID = %s', $this->getTable(), $values, $this->escape($id));
        $result = $this->connection->query($query);

        if (!$result) {
            throw new \Exception("Update not was success!", 1);
        }

        return $this->find($id);
    }

    /**
     * Delete a specified record
     * @param  string $id
     * @return array
     */
    public function delete(string $id = '')
    {
        $this->checkString($id);

        $query = sprintf('DELETE FROM %s WHERE ID = %s', $this->getTable(), $this->escape($id));
        $result = $this->connection->query($query);

        if (!$result) {
            throw new \Exception("Delete not was success!", 1);
        }

        return $this->all();
    }
}
