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
        Schema::create('horario_racion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('horario_id');
            $table->unsignedBigInteger('racion_id');

			#$table->primary(['id'],'primary_key_horario_racion');

            $table->foreign('horario_id')
                ->references('id')
                ->on('horario')
                ->onDelete('cascade');

            $table->foreign('racion_id')
                ->references('id')
                ->on('racion')
                ->onDelete('cascade');
            $table->unique(['horario_id','racion_id'],'unique_index_horario_racion');
            $table->index(['horario_id','racion_id'],'horarios_raciones_index');
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
