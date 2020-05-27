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
        Schema::create('paciente_cama', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('cama_id');
            $table->date('fecha');
			$table->date('fecha_fin')->nullable();#Agregar trigger, fecha > fecha_fin, paciente/cama + fecha => fecha > cualquier(fecha_fin con paciente/cama)
            $table->timestamps();

			#$table->primary(['id'],'primary_key_paciente_cama');
			#Creo que la siguiente key haría que un paciente pudiera estar internado en varias camas al mismo tiempo, según el modelo
            #$table->unique(['paciente_id','cama_id','fecha'],'pacientes_camas_paciente_id_fecha_unique');

			$table->unique(['paciente_id','fecha'],'pacientes_camas_unique_paciente_id_fecha');
			$table->unique(['cama_id','fecha'],'pacientes_camas_unique_cama_id_fecha');

            $table->foreign('paciente_id')
                ->references('id')
                ->on('paciente');

            $table->foreign('cama_id')
                ->references('id')
                ->on('cama');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paciente_cama');
    }
}
