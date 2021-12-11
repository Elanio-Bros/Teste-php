<?php

Dotenv\Dotenv::createUnsafeImmutable(file_exists('./.env') ? './' : '../')->load();
define('BASE', '/Teste-php-via-maquinas/');
define('DBDRIVER', getenv('DB_CONNECTION'));
define('DBHOST',getenv('DB_HOST').":".getenv('DB_PORT'));
define('DBNAME', getenv('DB_DATABASE'));
define('DBUSER', getenv('DB_USERNAME'));
define('DBPASS', getenv('DB_PASSWORD'));
