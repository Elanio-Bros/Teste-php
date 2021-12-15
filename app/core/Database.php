<?php

namespace App\Core;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => DBDRIVER,
            'host' => DBHOST,
            'database' => DBNAME,
            'username' => DBUSER,
            'password' => DBPASS,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $capsule->connection()->getPdo();
    }
    public static function migration($function)
    {

        $migrations = glob('app/database/migration/*.php', GLOB_NOESCAPE);
        foreach ($migrations as $migration) {
            preg_match("/(\w+).php/", $migration, $migration);
            $migration = "App\\Database\\Migration\\" . $migration[1];
            call_user_func_array([
                new $migration, $function
            ], []);
        }
    }
    public static function dropTables()
    {
        Capsule::schema()->dropAllTables();
    }

    public static function seeders()
    {
        $seeders = glob('app/database/seeders/*.php', GLOB_NOESCAPE);
        foreach ($seeders as $seeders) {
            preg_match("/(\w+).php/", $seeders, $seeders);
            $seeders = "App\\Database\\Seeders\\" . $seeders[1];
            call_user_func_array([
                new $seeders, "run"
            ], []);
        }
    }
}
