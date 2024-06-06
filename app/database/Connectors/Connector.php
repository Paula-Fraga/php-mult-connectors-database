<?php
namespace app\database\Connectors;

use PDO;
use Exception;
use PDOException;

class Connector 
{
    protected static $instance = null;

    public static function createConnection(array $options = [])
    {
        try {
            if (self::$instance === null) {
                self::$instance = self::createPdoConnection(
                    NEW_DB_DNS, NEW_DB_USERNAME, NEW_DB_PASSWORD, $options
                );
            }

            return self::$instance;

        } catch (PDOException $e) {
            throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    protected static function createPdoConnection($dsn, $username, $password, $options)
    {
        return new PDO($dsn, $username, $password, $options);
    }
}
