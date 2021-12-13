<?php
if (!@include_once('../app/config/functions.php')) {
    require_once 'app/config/functions.php';
} else {
    require_once '../app/config/functions.php';
}
require_once relative_locate('vendor/autoload.php');
require_once relative_locate('app/config/config.php');

try {
    new \App\Core\Database;
    new \App\Core\RouteCore;
} catch (Exception $e) {
    //criar exception bd
    (new App\Core\Messagem)->errorHttp(500, "Erro De Conexão com o Banco De Dados");
}
