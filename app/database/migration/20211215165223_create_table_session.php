<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Core\Database as Migration;
use Illuminate\Database\Schema\Blueprint;


class CreateTableSession extends Migration
{
    public function up()
    {
        Capsule::schema()->create('Sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->unique();
            $table->foreign('usuario_id')->references('id')->on('Usuarios');
            $table->string('hash_session');
            $table->boolean('remember')->default(0);
            $table->timestamp('start_at')->useCurrent();
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
