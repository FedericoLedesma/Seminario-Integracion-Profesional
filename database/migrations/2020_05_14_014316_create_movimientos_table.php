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
        Schema::create('movimiento', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('racion_disponible_id');
          $table->dateTime('creado');
          $table->unsignedBigInteger('user_id');
          $table->unsignedInteger('tipo_movimiento_id');
          $table->unsignedInteger('cantidad');#trigger: cantidad > 0
          /*$table->unsignedBigInteger('racion_id');#trigger: que settee racion y horario id.
          $table->unsignedBigInteger('horario_id');*/

		  #$table->primary(['id'],'primary_key_movimiento');

          $table->unique(['racion_disponible_id','creado','user_id','tipo_movimiento_id'],'unique_movimiento_racion_disponible_user_tipo');
          #$table->unique(['racion_id','horario_id','creado','user_id','tipo_movimiento_id'],'unique_movimiento_racion_horario_user_tipo');

          $table->foreign('racion_disponible_id')
              ->references('id')
              ->on('racion_disponible');

		  /*$table->foreign(['racion_id','horario_id'])
              ->references(['racion_id','horario_id'])
              ->on('racion_disponible');*/

          $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

          $table->foreign('tipo_movimiento_id')
              ->references('id')
              ->on('tipo_movimiento')
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
