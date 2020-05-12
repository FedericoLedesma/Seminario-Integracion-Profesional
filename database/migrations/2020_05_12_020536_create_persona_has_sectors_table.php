<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaHasSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_has_sectors', function (Blueprint $table) {
            $table->unsignedInteger('sector_id');
            $table->unsignedBigInteger('persona_id');
            $table->date('fecha');

            $table->foreign('sector_id')
                ->references('id')
                ->on('sectors')
                ->onDelete('cascade');

            $table->foreign('persona_id')
                ->references('id')
                ->on('personas')
                ->onDelete('cascade');


            $table->primary(['sector_id','persona_id','fecha'], 'persona_has_sectors_sector_id_persona_id_fecha_primary');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_has_sectors');
    }
}
