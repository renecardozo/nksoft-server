<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdAulaToSolicitudReservaAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_reserva_aulas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_aula')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_aula')->references('id')->on('aulas');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_reserva_aulas', function (Blueprint $table) {
            $table->dropColumn('id_aula');
            $table->dropColumn('id_user');
            $table->dropColumn('estado');
        });
    }
}
