<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Core\Database as Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableUsuario extends Migration
{
    public function up()
    {
        Capsule::schema()->create('Usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('usuario')->unique();
            $table->string('email')->unique();
            $table->text('senha');
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
