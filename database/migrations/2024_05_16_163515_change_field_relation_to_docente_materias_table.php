
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
            if (!Schema::hasColumn('docente_materia', 'docente_id')) {
                $table->unsignedBigInteger('docente_id');
                $table->foreign('docente_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('docente_materia', 'materia_id')) {
                $table->unsignedBigInteger('materia_id');
                $table->foreign('materia_id')->references('id')->on('materia')->onDelete('cascade');
            }
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
            $table->dropForeign(['docente_id']);
            $table->dropForeign(['materia_id']);
            $table->dropColumn('docente_id');
            $table->dropColumn('materia_id');
        });

        Schema::table('solicitud_reserva_aulas', function (Blueprint $table) {
            $table->dropColumn('cantidad_estudiantes');
            $table->dropColumn('observaciones');
        });
    }
}
