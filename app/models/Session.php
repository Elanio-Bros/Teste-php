<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Session extends Model
{
    protected $table = 'Sessions';
    public $timestamps = FALSE;
    protected $fillable = [
        'usuario_id',
        'hash_session',
        'remember'
    ];

    public function usuario()
    {
        return $this->hasMany(Usuario::class, 'id', 'usuario_id');
    }
}
