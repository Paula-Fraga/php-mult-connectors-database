<?php

namespace app\database\ActiveRecords;

use ReflectionClass;
use app\database\ActiveRecords\DatabaseManager;
use InvalidArgumentException;

class Model
{
    protected $table;
    protected $databaseStrategy;
    protected $attributes = [];

    public function __construct()
    {
        if (!$this->table) {
            $this->table = strtolower((new ReflectionClass($this))->getShortName());
            if (empty($this->table)) {
                throw new InvalidArgumentException("O nome da tabela não foi definido na model.");
            }
        }
        $this->databaseStrategy = DatabaseManager::getStrategy();
    }

    public function getTable()
    {
        return $this->table;
    }

    public function insert($data) 
    {
        return $this->databaseStrategy->insert($this->table, $data);
    }

    public function select($conditions = []) 
    {
        return $this->databaseStrategy->select($this->table, $conditions);
    }

    public function update($data, $conditions) 
    {
        return $this->databaseStrategy->update($this->table, $data, $conditions);
    }

    public function delete($conditions) 
    {
        return $this->databaseStrategy->delete($this->table, $conditions);
    }

    public function sql($sql) 
    {
        return $this->databaseStrategy->sql($sql);
    }
}
