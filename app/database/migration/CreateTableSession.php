<?php

namespace App\Database\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;


class CreateTableSession extends Migration
{
    public function up()
    {
        Capsule::schema()->create('Sessions', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
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
