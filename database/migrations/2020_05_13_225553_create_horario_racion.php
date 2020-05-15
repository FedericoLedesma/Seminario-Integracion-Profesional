<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioRacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_racion', function (Blueprint $table) {
            $table->unsignedInteger('horario_id');
            $table->unsignedBigInteger('racion_id');

            $table->foreign('horario_id')
                ->references('id')
                ->on('horarios')
                ->onDelete('cascade');

            $table->foreign('racion_id')
                ->references('id')
                ->on('racions')
                ->onDelete('cascade');
            $table->index(['horario_id','racion_id'],'horario_racion_index');
            $table->primary(['horario_id','racion_id'], 'horario_racion_horario_id_racion_id_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_racion');
    }
}
