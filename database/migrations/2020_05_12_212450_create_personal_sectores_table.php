<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalSectoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_sectores', function (Blueprint $table) {
            $table->unsignedInteger('sector_id');
            $table->unsignedBigInteger('personal_id');
            $table->date('fecha');

            $table->foreign('sector_id')
                ->references('id')
                ->on('sectores')
                ->onDelete('cascade');

            $table->foreign('personal_id')
                ->references('id')
                ->on('personal')
                ->onDelete('cascade');


            $table->primary(['sector_id','personal_id','fecha'], 'personal_sectores_sector_id_personal_id_fecha_primary');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_sectores');
    }
}
