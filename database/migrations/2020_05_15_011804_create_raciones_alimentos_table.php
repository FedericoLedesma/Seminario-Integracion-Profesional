<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacionesAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raciones_alimentos', function (Blueprint $table) {
            $table->unsignedBigInteger('racion_id');
            $table->unsignedBigInteger('alimento_id');
            $table->float('cantidad',5,2);
            $table->timestamps();

            $table->primary(['racion_id','alimento_id'],'racion_alimento_racion_id_alimento_idprimary_');

            $table->foreign('racion_id')
                ->references('id')
                ->on('raciones');

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
        Schema::dropIfExists('raciones_alimentos');
    }
}