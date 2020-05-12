<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dni');
            $table->string('apellido',50);
            $table->string('name',50);
            $table->string('observacion',100)->nullable($value = true);
            $table->string('direccion',50);
            $table->string('email');
            $table->string('provincia',50);
            $table->string('localidad',50);
            $table->string('sexo',25);
            $table->date('fecha_nac');
            $table->unsignedInteger('tipo_dni_id');
            $table->foreign('tipo_dni_id')->references('id')->on('tipo_dnis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
