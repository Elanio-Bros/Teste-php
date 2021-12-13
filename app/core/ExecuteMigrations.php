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
        foreach ($migrations as $migration) {
            preg_match("/(\w+).php/", $migration, $migration);
            $migration = "App\\Migration\\" . $migration[1];
            call_user_func_array([
                new $migration, $function
            ], []);
        }
    }
}
