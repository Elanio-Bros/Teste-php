<?php

namespace App\Core;

use App\Core\Controller;

class Messagem extends Controller
{
    protected static $erros;
    public function errorHttp(int $code, string $mesagem = null, string $log = null): void
    {
        if ($mesagem == null) {
            switch ($code) {
                case 404:
                    $mesagem = "Página Não Encontrada";
                    break;
                case 500:
                    $mesagem = "Error Interno do Servidor";
                    break;
            }
        }
        $this->load("error/http", [
            'messagem' => $mesagem,
            'code' => $code,
            'log' => $log,
        ]);
        die();
    }
}
