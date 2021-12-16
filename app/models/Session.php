<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Session extends Model
{
    protected $table = 'Sessions';
    public $timestamps = false;
    protected $fillable = [
        'usuario_id',
        'hash_session',
        'remember'
    ];
}
