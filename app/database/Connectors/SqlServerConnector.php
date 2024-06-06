<?php

namespace app\database\Connectors;

use PDO;
use Exception;
use PDOException;
use app\database\Connectors\ConnectorInterface;

final class SqlServerConnector implements ConnectorInterface
{
	protected static $instance = null;

	public function __construct()
	{}
	
	private function __clone()
	{}

	public static function connect(array $options = [])
	{
		if(self::$instance === null)
		{
			try {
                $dsn = DB_CONNECTION . ":Server=" . DB_HOST . "," . DB_PORT . ";Database=" . DB_DATABASE;
                self::$instance = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
            } catch (PDOException $e) {
                throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
		}

		return self::$instance;
	}
}
