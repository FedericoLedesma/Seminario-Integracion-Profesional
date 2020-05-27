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
        Schema::create('personal_especialidad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('personal_id');
            $table->unsignedInteger('especialidad_id');
            $table->date('fecha');

			#$table(['id'],'primary_key_personal_especialidad');

            $table->foreign('personal_id')
                ->references('id')
                ->on('personal')
                ->onDelete('cascade');

            $table->foreign('especialidad_id')
                ->references('id')
                ->on('especialidad')
                ->onDelete('cascade');

            $table->unique(['personal_id','especialidad_id','fecha'], 'personal_especialidades_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_especialidad');
    }
}
