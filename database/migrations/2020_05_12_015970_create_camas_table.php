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
        Schema::create('camas', function (Blueprint $table) {
            $table->unsignedInteger('cama_id');
            $table->unsignedInteger('habitacion_id');
            $table->unsignedInteger('sector_id');
            $table->timestamps();

            $table->foreign('habitacion_id','sector_id')
                ->references('habitacion_id','sector_id')
                ->on('habitaciones')
                ->onDelete('cascade');


            $table->primary(['cama_id','habitacion_id','sector_id'], 'camas_cama_id_habitacion_id_sector_id_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('camas');
    }
}