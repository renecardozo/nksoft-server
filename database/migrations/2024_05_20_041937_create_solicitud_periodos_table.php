<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudPeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_periodos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_reserva_aula_id');
            $table->foreign('solicitud_reserva_aula_id')->references('id')->on('solicitud_reserva_aulas')->onDelete('cascade');
            $table->unsignedBigInteger('periodo_id');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
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
        Schema::dropIfExists('solicitud_periodos');
    }
}
