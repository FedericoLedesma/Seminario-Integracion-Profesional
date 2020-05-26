<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidad', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('profesion_id');
            $table->string('name',50);
            $table->timestamps();

			#$table->primary(['id'],'primary_key_especialidad');

            $table->foreign('profesion_id')
                ->references('id')
                ->on('profesion')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidades');
    }
}
