<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacionesDisponiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('racion_disponible', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('horario_racion_id');
            $table->date('fecha');
            $table->unsignedInteger('stock_original')->nullable($value = true);
            $table->unsignedInteger('cantidad_restante')->nullable($value = true);
            $table->unsignedInteger('cantidad_realizados')->nullable($value = true);
            $table->timestamps();
            /*$table->unsignedBigInteger('racion_id');#trigger: que settee racion y horario id.
            $table->unsignedBigInteger('horario_id');*/

            /*$table->foreign(['racion_id','horario_id'])
              ->references(['racion_id','horario_id'])
              ->on('horario_racion');*/

            /*$table->foreign('racion_id')
                ->references('racion_id')
                ->on('horarios_raciones')
                ->onDelete('cascade');

            $table->foreign('horario_id')
                ->references('horario_id')
                ->on('horarios_raciones')
                ->onDelete('cascade');*/
            $table->foreign('horario_racion_id')
                ->references('id')
                ->on('horario_racion')
                ->onDelete('cascade');


            $table->unique(['horario_racion_id','fecha'],'index_raciones_disponibles_horario_racion_id_fecha');
            #$table->unique(['horario_id','racion_id','fecha'],'index_raciones_disponibles__hor_rac_id_fecha');
            $table->index(['horario_racion_id','fecha'],'raciones_disponibles_horario_id_racion_id_fecha_index');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('racion_disponible');
    }
}
