<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcompanantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acompanante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('paciente_id');
            $table->date('fecha');
            $table->date('fecha_fin')->nullable();

			#$table->primary(['id'],'primary_key_acompanante');

            $table->foreign('persona_id')
                ->references('id')
                ->on('persona')
                ->onDelete('cascade');

            $table->foreign('paciente_id')
                ->references('id')
                ->on('paciente')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['paciente_id','fecha','persona_id'], 'unique_acompanante_paciente_id_fecha');#Cada paciente puede tener un acompañante por fecha
            #$table->unique(['persona_id','fecha'], 'unique_acompanante_acompanante_id_fecha');#Cada acompañante puede tener un paciente por fecha
            #$table->unique(['persona_id','paciente_id','fecha'], 'unique_acompanante_acompanante_id_paciente_id_fecha');#Por si las moscas, comentar si pincha...
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acompanante');
    }
}
