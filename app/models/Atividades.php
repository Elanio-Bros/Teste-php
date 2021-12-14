<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class Atividades extends Model
{
    protected $table = 'Tarefas';
    protected $fillable = [
        'titulo', 'descrição', 'tipo_atividade', 'finalizada', 'finalizada_em'
    ];
}
