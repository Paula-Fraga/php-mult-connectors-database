<?php

namespace app\database\Connectors;

use Exception;
use ReflectionClass;

class ConnectorFactory
{
	public static function createConnection($options)
	{
		$connectors = include( __DIR__ . '/config/connectors.php');

		if(!array_key_exists(DB_CONNECTION, $connectors))
		{
			throw new Exception("Essa conexão não existe ou não está implementada!");
		}

		$connectorInstance = new ReflectionClass($connectors[DB_CONNECTION]);
		$connectorInstance = $connectorInstance->newInstance();

		return $connectorInstance::connect($options);
	}
}