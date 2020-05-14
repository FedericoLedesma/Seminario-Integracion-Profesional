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
            $table->unsignedBigInteger('racion_id')->index();
            $table->date('fecha');
            $table->unsignedInteger('horario_id');
            $table->unsignedInteger('stock_original')->nullable($value = true);
            $table->unsignedInteger('cantidad_restante')->nullable($value = true);
            $table->unsignedInteger('cantidad_realizados')->nullable($value = true);
            $table->timestamps();

            $table->foreign('racion_id')
                ->references('racion_id')
                ->on('horario_racion')
                ->onDelete('cascade');

            $table->foreign('horario_id')
                ->references('horario_id')
                ->on('horario_racion')
                ->onDelete('cascade');
            $table->index(['horario_id','racion_id','fecha'],'raciones_disponibles_horario_id_racion_id_fecha_index');
            $table->index(['fecha','horario_id','racion_id'],'index_');
            $table->index(['fecha','horario_id'],'fecha');
            $table->index(['fecha'],'index2');
            $table->index(['horario_id'],'index3');
            $table->index(['racion_id'],'index4');

            $table->primary(['horario_id','racion_id','fecha'], 'raciones_disponibles_horario_id_racion_id_fecha_primary');


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
