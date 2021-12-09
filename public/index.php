<?php
if (!@include_once('../app/config/functions.php')) {
    require_once 'app/config/functions.php';
} else {
    require_once '../app/config/functions.php';
}

require_once relative_locate('vendor/autoload.php');
require_once relative_locate('app/config/config.php');


new \App\Core\RouteCore;
