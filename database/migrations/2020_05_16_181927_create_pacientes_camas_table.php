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
            $table->unsignedBigInteger('paciente_id');
            $table->date('fecha');
            $table->unsignedInteger('cama_id');
            $table->unsignedInteger('habitacion_id');
            $table->unsignedInteger('sector_id');
            $table->timestamps();

            $table->primary(['paciente_id','fecha'],'pacientes_camas_paciente_id_fecha_primary');

            $table->foreign('paciente_id')
                ->references('id')
                ->on('pacientes');

            $table->foreign(['cama_id','habitacion_id','sector_id'])
                ->references(['cama_id','habitacion_id','sector_id'])
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
