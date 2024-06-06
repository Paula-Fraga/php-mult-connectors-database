<?php

namespace app\database\ActiveRecords;

use ReflectionClass;

class DatabaseManager
{
    private static $strategy = null;

    public static function getStrategy() 
	{
        if (self::$strategy === null) {
			$builds = self::loadConfig();
			$builder = (isset($builds[DB_CONNECTION])) ? $builds[DB_CONNECTION] : $builds['pattern'];
			$connectorInstance = new ReflectionClass($builder);
			self::$strategy = $connectorInstance->newInstance();
        }
        return self::$strategy;
    }

	private static function loadConfig(): array
    {
        return include(__DIR__ . '/config/builders.php');
    }
}
