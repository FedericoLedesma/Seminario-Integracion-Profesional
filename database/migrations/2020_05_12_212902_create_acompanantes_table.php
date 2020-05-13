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
        Schema::create('acompanantes', function (Blueprint $table) {
            $table->unsignedBigInteger('acompanante_id');
            $table->unsignedBigInteger('paciente_id');
            $table->date('fecha');

            $table->foreign('acompanante_id')
                ->references('id')
                ->on('personas')
                ->onDelete('cascade');

            $table->foreign('paciente_id')
                ->references('id')
                ->on('pacientes')
                ->onDelete('cascade');

            $table->timestamps();

            $table->primary(['paciente_id','fecha'], 'acompanantes_paciente_id_fecha_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acompanantes');
    }
}
