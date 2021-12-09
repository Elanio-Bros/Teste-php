<?php

namespace App\Core;

class RouteCore
{
    private $uri;
    private $method;

    private $getArr = [];
    private $postArr = [];

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
        $this->getArr[] = [
            'router' => $route,
            'callback' => $callback,
        ];
    }

    private function execute()
    {
        switch ($this->method) {
            case 'GET':
                foreach ($this->getArr as $get) {
                    if ($get['router'] == $this->uri) {
                        if (is_callable($get['callback'])) {
                            $get['callback']();
                            break;
                        }
                    }
                }
                break;
            case 'POST':
                break;
        }
    }
}
