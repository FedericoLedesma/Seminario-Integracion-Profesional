<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacionAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('racion_alimentos', function (Blueprint $table) {
            $table->unsignedBigInteger('racion_id');
            $table->unsignedBigInteger('alimento_id');
            $table->float('cantidad',5,2);
            $table->timestamps();

            $table->primary(['racion_id','alimento_id'],'racion_alimento_racion_id_alimento_idprimary_');

            $table->foreign('racion_id')
                ->references('id')
                ->on('racions');

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
        Schema::dropIfExists('racion_alimentos');
    }
}
