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
        Schema::create('dieta_activa_racion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dieta_activa_id');
            $table->unsignedBigInteger('racion_id');
            $table->date('fecha');

			#$table->primary(['id'],'primary_key_dieta_activa_racion');

            $table->foreign('dieta_activa_id')
                ->references('id')
                ->on('dieta_activa')
                ->onDelete('cascade');

            $table->foreign('racion_id')
                ->references('id')
                ->on('racion')
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
        Schema::dropIfExists('dieta_activa_racion');
    }
}
