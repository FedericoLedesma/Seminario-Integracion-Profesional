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
        Schema::create('patologia', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name',50);
            $table->string('descripcion',50)->nullable($value=true);
            $table->unsignedInteger('tipo_patologia_id')->nullable($value=true);
            $table->timestamps();

            $table->foreign('tipo_patologia_id')
                ->references('id')
                ->on('tipo_patologia')
                ->onDelete('cascade');
			
			$table->unique(['name'],'unique_patologia_name');

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
