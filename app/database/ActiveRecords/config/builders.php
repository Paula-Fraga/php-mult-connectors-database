<?php

return [
	'mysql' => \app\database\ActiveRecords\MysqlBuilder::class,
	'pgsql' => \app\database\ActiveRecords\PostgreSqlBuilder::class,
	'sqlsrv' => \app\database\ActiveRecords\SqlServerBuilder::class,
	'pattern' => \app\database\ActiveRecords\PatternBuilder::class
];