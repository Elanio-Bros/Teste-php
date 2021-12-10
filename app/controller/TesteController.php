<?php

namespace App\Controller;

use App\Core\Controller;

class TesteController extends Controller
{
    public function entrada()
    {
        $this->load('home', [
            'nome' => 'Bros',
            'subArr' => [
                ['nome' => 'João', 'idade' => 19],
                ['nome' => 'Maria', 'idade' => 18]
            ],
        ]);
    }
}
