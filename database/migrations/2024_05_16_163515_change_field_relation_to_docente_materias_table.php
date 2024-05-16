<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldRelationToDocenteMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('docente_materia', function (Blueprint $table) {
            $table->unsignedBigInteger('docente_id')->change();
            $table->unsignedBigInteger('materia_id')->change();
            $table->foreign('docente_id')->references('id')->on('users');
            $table->foreign('materia_id')->references('id')->on('materia');
        });
        Schema::table('solicitud_reserva_aulas', function (Blueprint $table) {
            $table->integer('cantidad_estudiantes')->nullable();
            $table->text('observaciones')->nullable();
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docente_materia', function (Blueprint $table) {
            $table->unsignedBigInteger('docente_id')->change();
            $table->unsignedBigInteger('materia_id')->change();
        });
        Schema::table('solicitud_reserva_aulas', function (Blueprint $table) {
            $table->dropColumn('cantidad_estudiantes');
            $table->dropColumn('observaciones');
        });
    }
}
