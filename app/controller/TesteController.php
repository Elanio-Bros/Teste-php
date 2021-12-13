<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Input;
use App\Models\Usuario;
use Illuminate\Database\Capsule\Manager as Capsule;

class TesteController extends Controller
{
    public function entrada()
    {
        if (Input::get('nome') != null) {
            echo Input::get('nome');
            Usuario::create(['id'=>'1','name' => Input::get('nome')]);
        }

        // echo Usuario::where('id','1')->get();
        $this->load('home', [
            'nome' => 'Bros',
            'subArr' => [
                ['nome' => 'João', 'idade' => 19],
                ['nome' => 'Maria', 'idade' => 18]
            ],
        ]);
    }
}
