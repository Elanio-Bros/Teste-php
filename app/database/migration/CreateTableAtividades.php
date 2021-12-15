<?php

namespace App\Database\Migration;

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
            $table->enum("tipo_atividade", ['desenvolvimento', 'atendimento', 'manutenção', 'manutenção urgente']);
            $table->boolean('finalizado')->default('0');
            $table->timestamps();
            $table->timestamp('finalizado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('Atividades');
    }
}
