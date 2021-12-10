<?php

namespace App\Core;

use App\Core\Messagem;

class RouteCore
{
    private $uri;
    private $method;

    private $routeArr = [];

    public function __construct()
    {
        $this->initialize();
        $locate = 'app/config/Route.php';
        require_once relative_locate($locate);
        $this->execute();
    }

    private function initialize()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $uri_local = $_SERVER['REQUEST_URI'];
        $this->uri = str_contains($uri_local, BASE) && BASE != '/' ?
            str_replace(BASE, '', "/$uri_local") : $uri_local;
    }

    private function get($route, $callback)
    {
        $this->routeArr['get'][] = [
            'router' => $route,
            'callback' => $callback,
        ];
    }
    private function post($route, $callback)
    {
        $this->routeArr['post'][] = [
            'router' => $route,
            'callback' => $callback,
        ];
    }


    private function execute()
    {
        switch ($this->method) {
            case 'GET':
                if ($this->valideRoutes($this->routeArr['get']) === false) {
                    (new Messagem)->errorHttp(404);
                    // echo "Rota Não Existe";
                }
                break;
            case 'POST':
                if ($this->valideRoutes($this->routeArr['post']) === false) {
                    (new Messagem)->errorHttp(404);
                }
                break;
        }
    }

    private function valideRoutes(array $routes)
    {
        $route = array_search($this->uri, array_column($routes, 'router'));
        if ($route === false) {
            return false;
        } else if (is_callable($routes[$route]['callback'])) {
            $routes[$route]['callback']();
        } else if (is_string($routes[$route]['callback'])) {
            $callback = explode('@', $routes[$route]['callback']);
            if (!isset($callback[0]) || !isset($callback[1])) {
                (new Messagem)->errorHttp(500, 'Controlador ou Método Não Encontrado');
                return;
            }

            $controller = 'app\\controller\\' . $callback[0];

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
    }
}
