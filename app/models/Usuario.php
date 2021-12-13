<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $fillable = [
        'name'
    ];
}
