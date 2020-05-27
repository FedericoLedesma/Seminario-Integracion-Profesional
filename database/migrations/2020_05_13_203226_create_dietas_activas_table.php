<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietasActivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dieta_activa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dieta_id');
            $table->dateTime('fecha');
            $table->date('fecha_final')->nullable($value=true);
            $table->string('observacion',100);
            $table->timestamps();

			#$table->primary(['id'],'primary_key_dieta_activa');

            $table->foreign('dieta_id')
                ->references('id')
                ->on('dieta')
                ->onDelete('cascade');

            $table->unique(['dieta_id','fecha'], 'unique_dietas_activas_dieta_id_fecha');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dieta_activa');
    }
}
