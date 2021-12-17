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
    public function home(string $error = null): void
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuarioSession = Session::firstWhere('hash_session', $_SESSION['usuario']['session']);
            if ($usuarioSession != null) {
                $diferenca = (new DateTime())->diff((new DateTime($usuarioSession['start_at'])));
                if ($usuarioSession['remember'] != true && $diferenca->h >= 4) {
                    $usuarioSession->delete();
                } else if ($diferenca->d >= 1) {
                    $usuarioSession->delete();
                } else {
                    $this->redirect(Routecore::getRouteName('entrada'));
                    die();
                }
            }
            $contaLogin = $_SESSION['usuario']['login'];
            session_destroy();
        }
        $this->load('conta/login', ['usuario' => (isset($contaLogin) ? $contaLogin : null)]);
    }
    public function login(): void
    {
        $request = new Input;
        Session::where('start_at', '<', date('Y-m-d H:i:s', strtotime('+2 days')))->delete();
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
                'remember' => $request->post('remeber', FILTER_VALIDATE_BOOLEAN) ? 1 : 0,
            ]);
            $this->redirect(Routecore::getRouteName('entrada'));
        } else {
            $this->home('Usuário ou Senha Invalidos');
        }
    }
    public function logout(): void
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $session = Session::firstWhere('hash_session', $_SESSION['usuario']['session']);
            if ($session != null) {
                $session->delete();
            }
        }
        session_destroy();
        $this->redirect(RouteCore::getRouteName('home'));
    }
}
