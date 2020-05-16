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
        Schema::create('dietas_activas', function (Blueprint $table) {
            $table->unsignedBigInteger('dieta_id');
            $table->date('fecha');
            $table->date('fecha_final')->nullable($value=true);
            $table->string('observacion',100);
            $table->timestamps();

            $table->foreign('dieta_id')
                ->references('id')
                ->on('dietas')
                ->onDelete('cascade');

            $table->primary(['dieta_id','fecha'], 'dietas_activas_dieta_id_fecha_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dietas_activas');
    }
}
