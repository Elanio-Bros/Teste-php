<?php
// (new App\Migration\CreateUsuario)->run();
namespace App\Core;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

class ExecuteMigrations
{
    public static function migration($function)
    {

        $migrations = glob('app/migration/*.php', GLOB_NOESCAPE);
        foreach ($migrations as $migation) {
            preg_match("/(\w+).php/", $migation, $migation);
            $migration = "App\\Migration\\" . $migation[1];
            call_user_func_array([
                new $migration, $function
            ], []);
        }
    }
}
