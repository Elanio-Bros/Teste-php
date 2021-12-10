<?php

namespace App\Core;

use App\Core\Controller;

class Messagem extends Controller
{
    public function errorHttp($code, $mesagem = null)
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
            'code' => $code
        ]);
    }
}
