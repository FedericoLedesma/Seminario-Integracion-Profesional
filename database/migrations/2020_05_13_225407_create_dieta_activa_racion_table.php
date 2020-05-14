<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietaActivaRacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dieta_activa_racion', function (Blueprint $table) {
            $table->unsignedBigInteger('dieta_id');
            $table->unsignedBigInteger('racion_id');
            $table->date('fecha');

            $table->foreign('dieta_id')
                ->references('id')
                ->on('dietas')
                ->onDelete('cascade');

            $table->foreign('racion_id')
                ->references('id')
                ->on('racions')
                ->onDelete('cascade');

            $table->primary(['dieta_id','racion_id','fecha'], 'dieta_activa_racion_dieta_id_racion_id_fecha_primary');

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
