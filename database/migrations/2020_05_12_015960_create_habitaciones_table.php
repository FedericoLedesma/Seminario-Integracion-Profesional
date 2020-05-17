<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->unsignedInteger('habitacion_id');
            $table->unsignedInteger('sector_id');
            $table->string('name',50);
            $table->string('descripcion',50)->nullable($value = true);
            $table->timestamps();

            $table->foreign('sector_id')
                ->references('id')
                ->on('sectores')
                ->onDelete('cascade');

              //$table->primary(['paciente_id','fecha'], 'acompanantes_paciente_id_fecha_primary');
              $table->primary(['habitacion_id','sector_id'], 'habitaciones_habitacion_id_sector_id_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habitaciones');
    }
}