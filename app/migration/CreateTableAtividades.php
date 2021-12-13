<?php

namespace App\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;


class CreateTableAtividades extends Migration
{
    public function up()
    {
        Capsule::schema()->create('Atividades', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descrição');
            $table->enum("tipo_atividade", ['desenvolvimento','atendimento','manutenção','manutenção urgente']);
            $table->boolean('finalizada');
            $table->timestamps();
            $table->timestamp('finalizada_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('atividades');
    }
}
