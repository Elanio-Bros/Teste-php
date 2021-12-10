<?php

namespace App\Core;

class Controller
{
    protected function load(string $view, $param = [])
    {
        $twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader(relative_locate('app/view'))
        );
        echo $twig->render($view . '.twig.php', $param);
    }
}
