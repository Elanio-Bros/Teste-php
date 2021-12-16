<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Input;
use App\Core\RouteCore;
use App\Models\Atividades;
use Illuminate\Database\Capsule\Manager as Capsule;

class AtivadesController extends Controller
{

    function __construct()
    {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            $this->redirect(RouteCore::getRouteName('home'));
            die();
        }
    }
    public function entrada()
    {
        $atividades = Atividades::where('finalizado', 0)->get();
        $atividades_finalizadas = Atividades::where('finalizado', 1)->get();
        $this->load('home', [
            'atividades' => $atividades,
            'finalizadas' => $atividades_finalizadas
        ]);
    }
    public function registrarAtividade()
    {
        $request = new Input;
        $day = date('D');
        $hour = intval(date('H'));
        $tipo = $request->post('tipo');
        if (($day != 'Fri' || $hour <= 13) || $tipo != 'manutenção urgente') {
            Atividades::create([
                'titulo' => $request->post('titulo'),
                'tipo_atividade' => $tipo,
                'descricao' => $request->post('descricao')
            ]);
            $this->redirect(RouteCore::getRouteName('entrada'));
        }
    }
    public function infoAtividade()
    {
        $request = new Input;
        if ($request->get('id') != null) {
            $atividade = Atividades::firstWhere('id', $request->get('id'));
            echo json_encode($atividade);
        } else {
            $this->redirect(Routecore::getRouteName('home'));
        }
    }
    public function atividadeFinalizada()
    {
        $request = new Input;
        $finalizado = $request->post('finalizado', FILTER_VALIDATE_BOOLEAN);
        Atividades::firstWhere('id', $request->post('id'))->update([
            'finalizado' => $finalizado ? 1 : 0,
            'finalizado_em' => $finalizado ? date('Y-m-d H:i:s') : NULL
        ]);
    }
    public function editarAtividade()
    {
        $request = new Input;
        $finalizado = $request->post('finalizado', FILTER_VALIDATE_BOOLEAN);
        Atividades::firstWhere('id', $request->post('id'))->update([
            'titulo' => $request->post('titulo'),
            'descricao' => $request->post('descricao'),
            'tipo_atividade' => $request->post('tipo'),
            'finalizado' => $finalizado ? 1 : 0,
        ]);
        $this->redirect(RouteCore::getRouteName('entrada'));
    }
    public function apagarAtividade()
    {
        $request = new Input;
        $atividade = Atividades::firstWhere('id', $request->post('id'));
        if ($atividade->tipo_atividade != 'manutenção urgente') {
            $atividade->delete();
        }
    }
}
