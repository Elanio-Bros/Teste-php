<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Input;
use App\Models\Usuario;
use Illuminate\Database\Capsule\Manager as Capsule;

class AtivadesController extends Controller
{
    public function entrada()
    {
        if (Input::get('nome') != null) {
            // echo Input::get('nome');
            Usuario::create(['name' => Input::get('nome'), 'sobrenome' => Input::get('sobrenome')]);
        }
        $pessoas = Usuario::all();
        $this->load('home', [
            'nome' => 'Bros',
            'subArr' => $pessoas,
        ]);
    }
}
