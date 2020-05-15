<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatologiaAlimentosProhibidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patologia_alimentos_prohibidos', function (Blueprint $table) {
            $table->unsignedIncrements('patologia_id');
            $table->unsignedBigInteger('alimento_id');
            $table->date('fecha');
            $table->timestamps();
            $table->primary(['patologia_id','alimento_id','fecha'],'patologia_alimentos_prohibidos_patologia_id_alimento_id_fecha_primary_');

            $table->foreign('patologia_id')
                ->references('id')
                ->on('patologias');

            $table->foreign('alimento_id')
                ->references('id')
                ->on('alimentos');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patologia_alimentos_prohibidos');
    }
}
