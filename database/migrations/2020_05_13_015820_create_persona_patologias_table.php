<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaPatologiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_patologias', function (Blueprint $table) {
          $table->unsignedInteger('patologia_id');
          $table->unsignedBigInteger('persona_id');
          $table->date('fecha');

          $table->foreign('patologia_id')
              ->references('id')
              ->on('patologias')
              ->onDelete('cascade');

          $table->foreign('persona_id')
              ->references('id')
              ->on('personas')
              ->onDelete('cascade');


          $table->primary(['patologia_id','persona_id','fecha'], 'persona_patolgias_patologia_id_persona_id_fecha_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_patologias');
    }
}
