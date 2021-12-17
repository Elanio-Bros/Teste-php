<?php

use App\Core\Messagem;

try {
    Dotenv\Dotenv::createUnsafeImmutable(file_exists('./.env') ? './' : '../')->load();
    define('BASE', '/Teste-php-via-maquinas/');
    define('DBDRIVER', (getenv('DB_CONNECTION') != null ? getenv('DB_CONNECTION') : 'mysql'));
    define('DBHOST', (getenv('DB_HOST') != null ? getenv('DB_HOST') : '127.0.0.1')  . ":" . (getenv('DB_PORT') != null ? getenv('DB_PORT') : '3306'));
    define('DBNAME', (getenv('DB_DATABASE') != null ? getenv('DB_DATABASE') : 'mysql'));
    define('DBUSER', (getenv('DB_USERNAME') != null ? getenv('DB_USERNAME') : 'root'));
    define('DBPASS', (getenv('DB_PASSWORD') != null ? getenv('DB_PASSWORD') : ''));
    date_default_timezone_set((getenv('TIME_ZONE') != null ?  getenv('TIME_ZONE') : 'America/Sao_Paulo'));
} catch (Exception $e) {
    if (isset($_SERVER['REQUEST_URI'])) {
        (new Messagem)->errorHttp(500, "Arquivo .env não encontrado", $e);
    } else {
        echo "Arquivo .env não encontrado";
    }
    die();
}
