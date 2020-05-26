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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('racion_disponible_id');
            $table->unsignedBigInteger('personal_id');
            #$table->unsignedBigInteger('dieta_id');
            $table->boolean('realizado');
            $table->timestamps();

            $table->foreign('racion_disponible_id')
                ->references('id')
                ->on('raciones_disponibles');

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

            $table->unique(['persona_id','racion_disponible_id'],'menus_personas_unique');

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
