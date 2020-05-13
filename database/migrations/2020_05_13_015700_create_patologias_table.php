<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatologiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patologias', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name',50);
            $table->string('descripcion',50)->nullable($value=true);
            $table->unsignedInteger('tipo_patologia_id')->nullable($value=true);
            $table->timestamps();

            $table->foreign('tipo_patologia_id')
                ->references('id')
                ->on('tipo_patologias')
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
        Schema::dropIfExists('patologias');
    }
}
