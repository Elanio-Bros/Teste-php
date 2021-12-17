<?php

namespace App\Core;

use App\Core\Messagem;

require_once relative_locate('app/routes/Routes.php');

class RouteCore
{
    private $uri;
    private $method;

    protected static $routeArr = [];

    public function __construct()
    {
        $this->initialize();
        $this->execute();
    }

    private function initialize(): void
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $uri_local = $_SERVER['REQUEST_URI'];
        if (strpos($uri_local, '?')) {
            $uri_local = mb_substr($uri_local, 0, strpos($uri_local, '?'));
        }
        $this->uri = str_contains($uri_local, BASE) && BASE != '/' ?
            str_replace(BASE, '', "/$uri_local") : $uri_local;
    }

    private function execute(): void
    {
        switch ($this->method) {
            case 'GET':
                if ($this->validateCallback(self::$routeArr['get']) === false) {
                    (new Messagem)->errorHttp(404);
                }
                break;
            case 'POST':
                if ($this->validateCallback(self::$routeArr['post']) === false) {
                    (new Messagem)->errorHttp(404);
                }
                break;
        }
    }

    private function validateCallback(array $routes): mixed
    {
        $route = array_search($this->uri, array_column($routes, 'router'));
        if ($route === false) {
            return false;
        } else if (is_callable($routes[$route]['callback'])) {
            return $routes[$route]['callback']();
        } else if (is_string($routes[$route]['callback'])) {
            return $this->validateStringCallback($routes[$route]['callback']);
        }
    }

    private function validateStringCallback(String $route): void
    {
        $callback = explode('@', $route);
        if (!isset($callback[0]) || !isset($callback[1])) {
            (new Messagem)->errorHttp(500, 'Controlador ou Método Não Encontrado');
            return;
        }
        $controller = 'App\\Controller\\' . $callback[0];

        if (!class_exists($controller)) {
            (new Messagem)->errorHttp(500, 'Controlador Não Existe');
            return;
        }
        if (!method_exists($controller, $callback[1])) {
            (new Messagem)->errorHttp(500, 'Método Não Existe');
            return;
        }
        call_user_func_array([
            new $controller, $callback[1]
        ], []);
    }

    public static function get($route, $callback, $name = null): void
    {
        self::$routeArr['get'][] = [
            'router' => $route,
            'callback' => $callback,
            'name' => $name,
        ];
    }
    public static function post($route, $callback, $name = null): void
    {
        self::$routeArr['post'][] = [
            'router' => $route,
            'callback' => $callback,
            'name' => $name,
        ];
    }

    public static function getRouteName($name): mixed
    {
        $url = $_SERVER['HTTP_HOST'];
        if (str_contains($_SERVER['REQUEST_URI'], BASE) && BASE !== '/') {
            $url = $url . rtrim(BASE, '/');
        }
        foreach (self::$routeArr as $key => $route) {
            $route = array_search($name, array_column($route, 'name'));
            if ($route !== false) {
                return "http://" . $url . self::$routeArr[$key][$route]['router'];
            }
        }
        return false;
    }
}
