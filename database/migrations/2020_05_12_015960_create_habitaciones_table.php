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
        Schema::create('habitacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('sector_id');
            $table->string('name' ,50);
            $table->string('descripcion' ,50)->nullable($value = true);
            $table->timestamps();

			#$table->primary(['id'],'primary_key_habitacion');

            $table->foreign('sector_id')
                ->references('id')
                ->on('sector')
                ->onDelete('cascade');

              //$table->primary(['paciente_id','fecha'], 'acompanantes_paciente_id_fecha_primary');
             #$table->unique('id','unique_sector_id');
			$table->unique(['sector_id','name'],'unique_sector_id_name');

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
