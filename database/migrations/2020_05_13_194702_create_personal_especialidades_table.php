<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_especialidades', function (Blueprint $table) {
            $table->unsignedBigInteger('personal_id');
            $table->unsignedInteger('especialidad_id');
            $table->date('fecha');

            $table->foreign('personal_id')
                ->references('id')
                ->on('personal')
                ->onDelete('cascade');

            $table->foreign('especialidad_id')
                ->references('id')
                ->on('especialidades')
                ->onDelete('cascade');

            $table->primary(['personal_id','especialidad_id','fecha'], 'personal_especialidades_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_especialidades');
    }
}
