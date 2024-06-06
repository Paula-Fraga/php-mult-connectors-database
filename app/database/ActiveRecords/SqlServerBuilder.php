<?php

namespace app\database\ActiveRecords;

use app\database\Connection;
use app\database\ActiveRecords\BuilderInterface;
use PDOException;

class SqlServerBuilder implements BuilderInterface
{    
    private $connection;

    public function __construct()
    {
        try {
            $pdo = new Connection;
            $this->connection = $pdo->connect();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function insert($table, $data)
    {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));

            $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
            $stmt = $this->connection->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao inserir dados: " . $e->getMessage());
        }
    }

    public function select($table, $conditions = [])
    {
        try {
            $sql = "SELECT * FROM {$table}";
            if (!empty($conditions)) {
                $whereClauses = [];
                foreach ($conditions as $column => $value) {
                    $whereClauses[] = "$column = :$column";
                }
                $sql .= " WHERE " . implode(" AND ", $whereClauses);
            }

            $stmt = $this->connection->prepare($sql);
            foreach ($conditions as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao selecionar dados: " . $e->getMessage());
        }
    }

    public function update($table, $data, $conditions)
    {
        try {
            $setClauses = [];
            foreach ($data as $column => $value) {
                $setClauses[] = "$column = :$column";
            }
            $sql = "UPDATE {$table} SET " . implode(", ", $setClauses);

            if (!empty($conditions)) {
                $whereClauses = [];
                foreach ($conditions as $column => $value) {
                    $whereClauses[] = "$column = :where_$column";
                }
                $sql .= " WHERE " . implode(" AND ", $whereClauses);
            }

            $stmt = $this->connection->prepare($sql);
            foreach ($data as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }
            foreach ($conditions as $column => $value) {
                $stmt->bindValue(":where_$column", $value);
            }

            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao atualizar dados: " . $e->getMessage());
        }
    }

    public function delete($table, $conditions)
    {
        try {
            $sql = "DELETE FROM {$table}";
            if (!empty($conditions)) {
                $whereClauses = [];
                foreach ($conditions as $column => $value) {
                    $whereClauses[] = "$column = :$column";
                }
                $sql .= " WHERE " . implode(" AND ", $whereClauses);
            }

            $stmt = $this->connection->prepare($sql);
            foreach ($conditions as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }

            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao excluir dados: " . $e->getMessage());
        }
    }

    public function sql($sql)
    {
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
