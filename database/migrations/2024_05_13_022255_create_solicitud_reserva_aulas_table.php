<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudReservaAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_reserva_aulas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_solicitud')->nullable();
            $table->string('motivo_reserva', 255)->nullable();
            $table->unsignedBigInteger('id_materia')->nullable();
            $table->unsignedBigInteger('id_horario')->nullable();
            $table->string('aula', 50)->nullable();
            $table->timestamp('fecha_hora_reserva')->nullable();
            $table->foreign('id_materia')->references('id')->on('materia');
            $table->foreign('id_horario')->references('id')->on('periodos');
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
        Schema::dropIfExists('solicitud_reserva_aulas');
    }
}
