<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Input;
use App\Core\RouteCore;
use App\Models\Atividades;
use Illuminate\Database\Capsule\Manager as Capsule;

class AtivadesController extends Controller
{
    private $day;
    private $hour;
    private $minute;
    function __construct()
    {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            $this->redirect(RouteCore::getRouteName('home'));
            die();
        }
        $this->day = strtolower(date('D'));
        $this->hour = intval(date('H'));
        $this->minute = intval(date('i'));
    }
    public function entrada($error = null)
    {
        $atividades = Atividades::where('finalizado', 0)->get();
        $atividades_finalizadas = Atividades::where('finalizado', 1)->get();
        $this->load('home', [
            'atividades' => $atividades,
            'finalizadas' => $atividades_finalizadas,
        ], $error);
    }
    public function registrarAtividade()
    {
        $request = new Input;
        $tipo = $request->post('tipo');
        if ($this->validacaoDateAtividade($tipo)) {
            $this->entrada("Tarefa " . $request->post('titulo') . " do tipo Manutenção Urgente não pode ser criado");
        } else {
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
        $atividade = Atividades::firstWhere('id', $request->post('id'));
        if ($this->validacaoDescricao($atividade['descricao'], $atividade)) {
            echo json_encode(['error' => 'Não Pode Ser Finalizado Descrição com menos de 50 caracteres']);
        } else {
            $finalizado = $request->post('finalizado', FILTER_VALIDATE_BOOLEAN);
            $atividade->update([
                'finalizado' => $finalizado ? 1 : 0,
                'finalizado_em' => $finalizado ? date('Y-m-d H:i:s') : NULL
            ]);
        }
    }
    public function editarAtividade()
    {
        $request = new Input;
        $finalizado = $request->post('finalizado', FILTER_VALIDATE_BOOLEAN);
        $tipo = $request->post('tipo');
        if ($this->validacaoDateAtividade($tipo)) {
            $this->entrada("Tarefa " . $request->post('titulo') . " Tipo não pode ser alterado");
        } else if ($finalizado && $this->validacaoDescricao($request->post('descricao'), array('tipo_atividade' => $request->post('tipo')))) {
            $this->entrada('Não Pode Ser Finalizado Descrição com menos de 50 caracteres');
        } else {
            Atividades::firstWhere('id', $request->post('id'))->update([
                'titulo' => $request->post('titulo'),
                'descricao' => $request->post('descricao'),
                'tipo_atividade' => $request->post('tipo'),
                'finalizado' => $finalizado ? 1 : 0,
            ]);
            $this->redirect(RouteCore::getRouteName('entrada'));
        }
    }
    public function apagarAtividade()
    {
        $request = new Input;
        $atividade = Atividades::firstWhere('id', $request->post('id'));
        if ($atividade->tipo_atividade != 'manutenção urgente') {
            $atividade->delete();
        } else {
            $this->entrada('Não Pode Ser Apagado');
        }
    }
    private function validacaoDateAtividade($tipo)
    {
        return $this->day == 'fri' && $this->hour >= 13
            && $this->minute > 0 &&
            $tipo == 'manutenção urgente';
    }
    private function validacaoDescricao($descricao, $atividade)
    {
        return strlen($descricao) < 50 && ($atividade['tipo_atividade'] == 'atendimento' || $atividade['tipo_atividade'] == 'manutenção urgente');
    }
}
