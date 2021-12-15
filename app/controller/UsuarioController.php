<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Input;
use App\Core\Messagem;
use App\Models\Usuario;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Core\RouteCore;

class UsuarioController extends Controller
{
    public function home()
    {
        $this->load('conta/login');
    }
    public function login()
    {
        $request = new Input;
        $usuario = Usuario::where('usuario', '=', $request->post('usuario'))
            ->orWhere('email', '=', $request->post('usuario'))->first();
        if ($usuario !== null && password_verify($request->post('senha'), $usuario['senha'])) {
            $hash = bin2hex(random_bytes(16));
            session_start();
            $_SESSION['usuario'] = [
                'sesion_hash' => $hash,
                'nome' => $usuario['nome'],
                'usuario' => $usuario['usuario'],
                'email' => $usuario['email']
            ];
            $this->redirect(Routecore::getRouteName('entrada'));
        } else {
            $this->load('conta/login', ['error' => 'Usuário ou Senha Invalidos']);
        }
    }
    public function logout()
    {
        session_start();
        session_destroy();
        $this->redirect(RouteCore::getRouteName('home'));
    }
    public function conta()
    {
        $this->load('conta/criarConta');
    }
    public function criarConta()
    {
        // $this->load('conta/criarConta');
    }
}
