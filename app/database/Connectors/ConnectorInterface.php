<?php

namespace app\database\Connectors;

interface ConnectorInterface
{
	public static function connect(array $options = []);
}
