<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietasActivasRacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dietas_activas_raciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dieta_activa_id');
            $table->unsignedBigInteger('racion_id');
            $table->date('fecha');

            $table->foreign('dieta_activa_id')
                ->references('id')
                ->on('dietas_activas')
                ->onDelete('cascade');

            $table->foreign('racion_id')
                ->references('id')
                ->on('raciones')
                ->onDelete('cascade');

            $table->unique(['dieta_activa_id','racion_id','fecha'], 'dietas_activas_raciones_dieta_id_racion_id_fecha_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dietas_activas_raciones');
    }
}
