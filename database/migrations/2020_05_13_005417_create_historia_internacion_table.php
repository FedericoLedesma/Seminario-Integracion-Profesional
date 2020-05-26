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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paciente_id');
            $table->date('fecha_ingreso');
            $table->float('peso',5,2)->nullable($value = true);
            $table->date('fecha_egreso')->nullable($value = true);
            $table->timestamps();

			#$table->primary(['id'],'primary_key_historia_internacion');

            $table->foreign('paciente_id')
                ->references('id')
                ->on('paciente')
                ->onDelete('cascade');

            $table->unique(['paciente_id','fecha_ingreso'], 'unique_historia_internacion_paciente_id_fecha_ingreso');
            $table->unique(['paciente_id','fecha_egreso'], 'unique_historia_internacion_paciente_id_fecha_egreso');
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
