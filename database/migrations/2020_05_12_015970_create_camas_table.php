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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('habitacion_id');
            $table->timestamps();

            $table->foreign('habitacion_id')
                ->references('id')
                ->on('habitaciones');
            $table->unique(['id','habitacion_id'],'unique');
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
