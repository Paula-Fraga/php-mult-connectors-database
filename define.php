<?php

# Banco de dados. Aceita: pgsql, sqlsrv ou mysql.
define('DB_CONNECTION', null); 
define('DB_HOST', null);
define('DB_PORT', null);
define('DB_DATABASE', null);
define('DB_USERNAME', null);
define('DB_PASSWORD', null);

# Usado para qualquer outro tipo de banco de dados.
define('NEW_DB_CONNECTION', 'pattern'); // Padrão, não pode mudar.
define('NEW_DB_DNS', null);
define('NEW_DB_USERNAME', null);
define('NEW_DB_PASSWORD', null);

# Usado para setar atributos da conenxão
define('COLUMNS_BD', 'NATURAL'); // LOWER / NATURAL / UPPER
define('RETURN_BD', 'ARRAY'); // ARRAY / OBJECT
