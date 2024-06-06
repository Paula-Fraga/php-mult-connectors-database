<?php

namespace app\database\ActiveRecords;

use PDOException;
use app\database\Connection;
use app\database\ActiveRecords\BuilderInterface;

class PatternBuilder implements BuilderInterface
{
	private $connection;

    public function __construct() {
        try {
            $pdo = new Connection;
            $this->connection = $pdo->connect();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function insert($table, $data)
    {
        return false; 
    }

    public function select($table, $conditions)
    {
        return false; 
    }

    public function update($table, $data, $conditions)
    {
        return false; 
    }

    public function delete($table, $conditions)
    {
        return false; 
    }

    public function sql($sql) {
        try {
            $sqlType = strtoupper(substr(trim($sql), 0, 6));
    
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
    
            switch ($sqlType) {
                case 'SELECT':
                    return $stmt->fetchAll();
                case 'INSERT':
                    return $this->connection->lastInsertId();
                case 'UPDATE':
                case 'DELETE':
                    return $stmt->rowCount();
                default:
                    return null;
            }
        } catch (PDOException $e) {
            throw new PDOException("Erro ao executar consulta SQL: " . $e->getMessage());
        }
    }

}
