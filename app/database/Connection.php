<?php

namespace app\database;

use PDO;
use Exception;
use PDOException;
use app\database\Connectors\Connector;
use app\database\Connectors\ConnectorFactory;

class Connection
{
    public function connect(): PDO
    {
        try {
            $options = $this->loadConfig();
            $attributes = $this->buildAttributes($options);

            return $this->createConnection($attributes);
        } catch (PDOException $e) {
            throw new Exception("Problemas na conexão: " . $e->getMessage());
        }
    }

    private function loadConfig(): array
    {
        return include(__DIR__ . '/Connectors/config/attributes.php');
    }

    private function buildAttributes(array $options): array
    {
        $attributes = [];

        if (isset($options['COLUMNS_BD'][COLUMNS_BD])) {
            $attributes = $attributes + $options['COLUMNS_BD'][COLUMNS_BD];
        }

        if (isset($options['RETURN_BD'][RETURN_BD])) {
            $attributes = $attributes + $options['RETURN_BD'][RETURN_BD];
        }

        $attributes[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

        return $attributes;
    }

    private function createConnection(array $attributes)
    {
        if (DB_CONNECTION) {
            return ConnectorFactory::createConnection($attributes);
        }

        if (NEW_DB_CONNECTION) {
            return Connector::createConnection($attributes);
        }

        throw new Exception("Conexão não está setada!");
    }
}

