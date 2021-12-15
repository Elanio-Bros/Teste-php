<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Input;
use App\Core\RouteCore;
use App\Models\Atividades;
use Illuminate\Database\Capsule\Manager as Capsule;

class AtivadesController extends Controller
{
    public function entrada()
    {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            $this->redirect(RouteCore::getRouteName('home'));
        }
        $atividades = Atividades::where('finalizado', 0)->get();
        $finalizadas = Atividades::where('finalizado', 1)->get();
        $this->load('home', [
            'atividades' => $atividades,
            'finalizadas' => $finalizadas
        ]);
    }
    public function registrarAtividade()
    {
        $request = new Input;
        Atividades::create([
            'titulo' => $request->post('titulo'),
            'tipo_atividade' => $request->post('tipo'),
            'descrição' => $request->post('descricao')
        ]);
        $this->redirect(RouteCore::getRouteName('entrada'));
    }
    public function atividadeFinalizada()
    {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            $this->redirect(RouteCore::getRouteName('home'));
        }
        $request = new Input;
        Atividades::firstWhere('id', $request->post('id'))->update([
            'finalizado' => $request->post('finalizado') == 'true' ? 1 : 0,
            'finalizado_em' => $request->post('finalizado') == 'true' ? date('Y-m-d H:i:s') : NULL
        ]);
    }
}
