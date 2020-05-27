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
        Schema::create('patologia_alimento_prohibido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('patologia_id');
            $table->unsignedBigInteger('alimento_id');
            $table->date('fecha');
            $table->timestamps();

			#$table->primary(['id'],'primary_key_patologia_alimento_prohibido');

            $table->unique(['patologia_id','alimento_id','fecha'],'patologia_alimentos_prohibidos_primary_');

            $table->foreign('patologia_id')
                ->references('id')
                ->on('patologia');

            $table->foreign('alimento_id')
                ->references('id')
                ->on('alimento');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patologia_alimento_prohibido');
    }
}
