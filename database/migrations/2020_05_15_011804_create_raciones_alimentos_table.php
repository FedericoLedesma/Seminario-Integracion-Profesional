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
        Schema::create('racion_alimento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('racion_id');
            $table->unsignedBigInteger('alimento_id');
            $table->float('cantidad',5,2);
            $table->timestamps();

			#$table->primary(['id'],'primary_key_racion_alimento');

            $table->unique(['racion_id','alimento_id'],'racion_alimento_racion_id_alimento_id_unique');

            $table->foreign('racion_id')
                ->references('id')
                ->on('racion')
                ->onDelete('cascade');

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
        Schema::dropIfExists('racion_alimento');
    }
}
