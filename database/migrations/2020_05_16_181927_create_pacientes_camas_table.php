<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesCamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_camas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('cama_id');
            $table->date('fecha');
            $table->timestamps();

            $table->unique(['paciente_id','cama_id','fecha'],'pacientes_camas_paciente_id_fecha_unique');

            $table->foreign('paciente_id')
                ->references('id')
                ->on('pacientes');

            $table->foreign('cama_id')
                ->references('id')
                ->on('camas');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes_camas');
    }
}
