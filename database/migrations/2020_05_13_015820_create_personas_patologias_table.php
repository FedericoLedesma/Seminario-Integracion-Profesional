<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasPatologiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_patologia', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('patologia_id');
          $table->unsignedBigInteger('persona_id');
          $table->date('fecha');
          $table->date('hasta')->nullable($value = true);

		  #$table->primary(['id'],'primary_key_persona_patologia');

          $table->foreign('patologia_id')
              ->references('id')
              ->on('patologia')
              ->onDelete('restrict');

          $table->foreign('persona_id')
              ->references('id')
              ->on('persona')
              ->onDelete('restrict');


          $table->unique(['patologia_id','persona_id','fecha'], 'personas_patolgias_patologia_id_persona_id_fecha_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas_patologias');
    }
}
