<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus_personas', function (Blueprint $table) {

            $table->unsignedBigInteger('persona_id');
            $table->unsignedInteger('horario_id');
            $table->unsignedBigInteger('racion_id');
            $table->date('fecha');
            $table->unsignedBigInteger('personal_id');
            #$table->unsignedBigInteger('dieta_id');
            $table->boolean('realizado');
            $table->timestamps();

            $table->foreign('fecha','horario_id','racion_id')
                ->references('fecha','horario_id','racion_id')
                ->on('raciones_disponibles')
                ->onDelete('cascade');

            $table->foreign('persona_id')
                ->references('id')
                ->on('personas')
                ->onDelete('cascade');

            $table->foreign('personal_id')
                ->references('id')
                ->on('personal')
                ->onDelete('cascade');

            /*$table->foreign('dieta_id')
                ->references('id')
                ->on('dietas')
                ->onDelete('cascade');*/

            $table->primary(['fecha','persona_id','horario_id'], 'menus_personas_fecha_persona_id_horario_id_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus_personas');
    }
}
