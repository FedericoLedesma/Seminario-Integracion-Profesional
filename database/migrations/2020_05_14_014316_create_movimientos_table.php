<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {

          $table->unsignedInteger('horario_id');
          $table->unsignedBigInteger('racion_id');
          $table->date('fecha');
          $table->dateTime('created_at');
          $table->unsignedBigInteger('user_id');
          $table->unsignedInteger('tipo_movimiento_id');

          $table->index(['fecha','horario_id','racion_id'],'index_movimientos');

          $table->foreign('fecha','horario_id','racion_id')
              ->references('fecha','horario_id','racion_id')
              ->on('raciones_disponibles')
              ->onDelete('cascade');

          $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

          $table->foreign('tipo_movimiento_id')
              ->references('id')
              ->on('tipo_movimientos')
              ->onDelete('cascade');

          $table->primary(['racion_id','fecha','horario_id','created_at','user_id','tipo_movimiento_id'],'movimiento_racion_id_fecha_horario_id_created_at_user_id_tipo_movimiento_id_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
