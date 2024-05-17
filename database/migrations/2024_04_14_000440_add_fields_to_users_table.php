<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable();
            $table->string('ci')->nullable();
            $table->string('code_sis')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();           
        });
        //DB::update('alter table `inventories` modify `sku` VARCHAR(200) UNIQUE NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        /*
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_name', 'ci', 'code_sis','phone', 'role_id']);
        });
        */
    }
}
