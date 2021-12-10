<?php
if (!@include_once('../app/config/functions.php')) {
    require_once 'app/config/functions.php';
} else {
    require_once '../app/config/functions.php';
}
require_once relative_locate('vendor/autoload.php');
#load env
Dotenv\Dotenv::createUnsafeImmutable(file_exists('./.env') ? './' : '../')->load();

#load config
require_once relative_locate('app/config/config.php');
new \App\Core\RouteCore;
