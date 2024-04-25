<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rol_id');
            $table->string('nombreUsuario');
            $table->string('apellidoUsuarios');
            $table->string('ciUsuarios');
            $table->string('codSisUsuarios');
            $table->string('correoUsuarios');
            $table->date('fechaRegistroUsuarios');
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
        Schema::dropIfExists('usuarios');
    }
}