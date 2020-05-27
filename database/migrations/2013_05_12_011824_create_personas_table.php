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
        Schema::create('persona', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('numero_doc');
            $table->string('apellido',50);
            $table->string('name',50);
            $table->string('observacion',100)->nullable($value = true);
            $table->string('direccion',50)->nullable();
            $table->string('email')->nullable();
            $table->string('provincia',50);
            $table->string('localidad',50);
            $table->string('sexo',25);
            $table->date('fecha_nac')->nullable();
            $table->unsignedInteger('tipo_documento_id');


			      #$table->primary(['id'],'primary_key_persona');

            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');
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
        Schema::dropIfExists('persona');
    }
}
