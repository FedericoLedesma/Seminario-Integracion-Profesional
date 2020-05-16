<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosRacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios_raciones', function (Blueprint $table) {
            $table->unsignedInteger('horario_id');
            $table->unsignedBigInteger('racion_id');

            $table->foreign('horario_id')
                ->references('id')
                ->on('horarios')
                ->onDelete('cascade');

            $table->foreign('racion_id')
                ->references('id')
                ->on('raciones')
                ->onDelete('cascade');
            $table->index(['horario_id','racion_id'],'horarios_raciones_index');
            $table->primary(['horario_id','racion_id'], 'horarios_raciones_horario_id_racion_id_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios_raciones');
    }
}
