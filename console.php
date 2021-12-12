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

$application->add(new Command\Migration);
$application->add(new Command\RollBackMigration);
$application->run();
