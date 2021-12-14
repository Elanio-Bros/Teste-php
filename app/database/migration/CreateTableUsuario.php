<?php

namespace App\Database\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableUsuario extends Migration
{
    public function up()
    {
        Capsule::schema()->create('Usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('usuario');
            $table->string('email');
            $table->text('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('usuarios');
    }
}
