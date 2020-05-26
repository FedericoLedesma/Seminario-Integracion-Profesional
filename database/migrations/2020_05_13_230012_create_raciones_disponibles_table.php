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
        Schema::create('raciones_disponibles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('horario_racion_id');
            $table->date('fecha');
            $table->unsignedInteger('stock_original')->nullable($value = true);
            $table->unsignedInteger('cantidad_restante')->nullable($value = true);
            $table->unsignedInteger('cantidad_realizados')->nullable($value = true);
            $table->timestamps();

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
                ->on('horarios_raciones')
                ->onDelete('cascade');


            $table->unique(['horario_racion_id','fecha'],'index_raciones_disponibles_');
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
        Schema::dropIfExists('raciones_disponibles');
    }
}
