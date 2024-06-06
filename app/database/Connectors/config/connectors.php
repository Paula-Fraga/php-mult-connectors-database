<?php

return [
	'mysql' => \app\database\Connectors\MysqlConnector::class,
	'pgsql' => \app\database\Connectors\PostgreSqlConnector::class,
	'sqlsrv' => \app\database\Connectors\SqlServerConnector::class
];