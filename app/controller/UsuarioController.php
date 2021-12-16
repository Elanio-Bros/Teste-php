<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Input;
use App\Core\Messagem;
use App\Models\Usuario;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Core\RouteCore;
use App\Models\Session;
use DateTime;

class UsuarioController extends Controller
{
    public function home($error = null)
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = Session::firstWhere('hash_session', $_SESSION['usuario']['session']);
            $diferenca = (new DateTime())->diff((new DateTime($usuario['start_at'])));
            if ($usuario['remember'] != true && $diferenca->h >= 4) {
                $usuario->delete();
            } else if ($diferenca->d >= 1) {
                $usuario->delete();
            } else {
                $this->redirect(Routecore::getRouteName('entrada'));
                die();
            }
            $this->load('conta/login', ['usuario' => $_SESSION['usuario']['login']]);
            session_destroy();
        }
        $this->load('conta/login', [], $error);
    }
    public function login()
    {
        $request = new Input;
        $usuario = Usuario::where('usuario', '=', $request->post('usuario'))
            ->orWhere('email', '=', $request->post('usuario'))->first();
        if ($usuario != null && password_verify($request->post('senha'), $usuario['senha'])) {
            $hash = bin2hex(random_bytes(16));
            session_start();
            $_SESSION['usuario'] = [
                'session' => $hash,
                'login' => $request->post('usuario'),
            ];
            Session::create([
                'usuario_id' => $usuario['id'],
                'hash_session' => $hash,
                'remember' => $request->post('remeber', FILTER_VALIDATE_BOOLEAN) ? 1 : 0
            ]);
            $this->redirect(Routecore::getRouteName('entrada'));
        } else {
            $this->home('Usuário ou Senha Invalidos');
        }
    }
    public function logout()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            Session::firstWhere('hash_session', $_SESSION['usuario']['session'])->delete();
        }
        session_destroy();
        $this->redirect(RouteCore::getRouteName('home'));
    }
}
