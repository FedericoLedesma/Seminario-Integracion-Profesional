<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriaInternacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia_internacion', function (Blueprint $table) {
            $table->unsignedBigInteger('paciente_id');
            $table->date('fecha_ingreso');
            $table->float('peso',5,2)->nullable($value = true);
            $table->date('fecha_egreso')->nullable($value = true);
            $table->timestamps();

            $table->foreign('paciente_id')
                ->references('id')
                ->on('pacientes')
                ->onDelete('cascade');

            $table->primary(['paciente_id','fecha_ingreso'], 'historia_internacion_paciente_id_fecha_ingreso_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historia_internacion');
    }
}
