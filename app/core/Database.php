<?php

namespace App\Core;

use DateTime;
use DateTimeZone;
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
        $this->setTimeZoneDataBase();
        $capsule->connection()->getPdo();
    }
    public static function migration($function): void
    {
        $fileMigrations = glob('app/database/migration/*.php', GLOB_NOESCAPE);
        foreach ($fileMigrations as $fileMigration) {
            preg_match("/(\w+).php/", $fileMigration, $fileMigration);
            $class = implode(array_map(function ($value) {
                return ucfirst($value);
            }, array_slice(explode('_', $fileMigration[1]), 1)));
            require_once $migration;
            (new $class)->$function();
        }
    }
    public static function dropTables(): void
    {
        Capsule::schema()->dropAllTables();
    }

    public static function seeders(): void
    {
        $seeders = glob('app/database/seeders/*.php', GLOB_NOESCAPE);
        foreach ($seeders as $seeders) {
            preg_match("/(\w+).php/", $seeders, $seeders);
            $seeders = "App\\Database\\Seeders\\" . $seeders[1];
            (new $seeders)->run();
        }
    }

    private function setTimeZoneDataBase(): void
    {
        try {
            Capsule::update("SET time_zone='" . date_default_timezone_get() . "'");
        } catch (Exception $e) {
            $timezone = new DateTimeZone(date_default_timezone_get());
            $seconds = timezone_offset_get($timezone, new DateTime());
            $minutes = round($seconds / 60);
            $hours = floor($minutes / 60);
            $remainMinutes = ($minutes % 60);
            $offset = sprintf('%+d:%02d', $hours, $remainMinutes);
            Capsule::update("SET time_zone='$offset'");
        }
    }
}
