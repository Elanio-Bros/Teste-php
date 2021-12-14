<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Input;
use App\Models\Usuario;
use Illuminate\Database\Capsule\Manager as Capsule;

class UsuarioController extends Controller
{
    public function login()
    {
        $this->load('conta/login');
    }
    public function criarConta()
    {
        $this->load('conta/criarConta');
    }
}
