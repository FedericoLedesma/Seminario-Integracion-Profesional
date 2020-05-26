<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_movimiento', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name' ,50);
            $table->timestamps();
			         $table->string('query')->nullable();

			#$table->primary(['id'],'primary_key_tipo_movimiento');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_movimientos');
    }
}
