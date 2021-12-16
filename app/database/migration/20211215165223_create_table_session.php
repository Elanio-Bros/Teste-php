<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Core\Database as Migration;
use Illuminate\Database\Schema\Blueprint;


class CreateTableSession extends Migration
{
    public function up()
    {
        Capsule::raw("SET GLOBAL time_zone='" . TIME_ZONE . "'");
        Capsule::schema()->create('Sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('Usuarios');
            $table->string('hash_session')->unique();
            $table->boolean('remember')->default(0);
            $table->timestamp('start_at')->default(date("Y-m-d H:i:s"));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('Sessions');
    }
}
