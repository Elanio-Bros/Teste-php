<?php

namespace App\Database\Seeders;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Usuario;

class UsuariosSeeder
{
    public function run()
    {
        Usuario::create([
            'nome' => 'Admin',
            'usuario' =>  'Admin',
            'email' =>  'Admin@gmail.com',
            'senha' => password_hash('senhaAdmin', PASSWORD_DEFAULT),
        ]);
    }
}
