<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cama', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('habitacion_id');
            $table->timestamps();

			#$table->primary(['id'],'primary_key_cama');

            $table->foreign('habitacion_id')
                ->references('id')
                ->on('habitacion');
            $table->unique(['id','habitacion_id'],'unique_cama_id_habitacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cama');
    }
}
