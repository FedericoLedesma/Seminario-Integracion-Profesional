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
          $table->bigIncrements('id');
          $table->unsignedBigInteger('racion_disponible_id');
          $table->dateTime('creado');
          $table->unsignedBigInteger('user_id');
          $table->unsignedInteger('tipo_movimiento_id');
          $table->unsignedInteger('cantidad');



          $table->unique(['racion_disponible_id','creado','user_id','tipo_movimiento_id'],'movimiento_racion_primary_');

          $table->foreign('racion_disponible_id')
              ->references('id')
              ->on('raciones_disponibles');

          $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

          $table->foreign('tipo_movimiento_id')
              ->references('id')
              ->on('tipos_movimientos')
              ->onDelete('cascade');



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
