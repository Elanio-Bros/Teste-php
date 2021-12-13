<?php
// application.php
if (!@include_once('../app/config/functions.php')) {
    require_once 'app/config/functions.php';
} else {
    require_once '../app/config/functions.php';
}
require_once relative_locate('vendor/autoload.php');
require_once relative_locate('app/config/config.php');

new \App\Core\Database;

use Symfony\Component\Console\Application;
use App\Command;

$application = new Application();

// ... register commands
$commands = glob('app/command/*.php', GLOB_NOESCAPE);
foreach ($commands as $command) {
    preg_match("/(\w+).php/", $command, $command);
    $command = "App\\Command\\" . $command[1];
    $application->add(new $command);
}
$application->run();
