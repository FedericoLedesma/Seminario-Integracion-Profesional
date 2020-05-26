<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposPatologiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_patologia', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name' ,50);
            $table->string('observacion' ,50)->nullable($value=true);
            $table->timestamps();

			#$table->primary(['id'],'primary_key_tipo_patologia');

			$table->unique(['name'],'unique_tipo_patologia_name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_patologias');
    }
}
