<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_config', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Adds a `name` column of type string
            $table->string('code'); // Adds a `code` column of type string
            $table->string('color'); // Adds a `color` column of type string
            $table->string('hex_color'); // Adds a `hex_color` column of type string
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
        Schema::dropIfExists('events_config');
    }
}
