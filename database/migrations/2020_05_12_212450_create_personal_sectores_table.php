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
        Schema::create('personal_sector', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('sector_id');
            $table->unsignedBigInteger('personal_id');
            $table->date('fecha');

			#$table->primary(['id'],'primary_key_personal_sector');

            $table->foreign('sector_id')
                ->references('id')
                ->on('sector')
                ->onDelete('cascade');

            $table->foreign('personal_id')
                ->references('id')
                ->on('personal')
                ->onDelete('cascade');


            $table->unique(['personal_id','fecha'], 'unique_personal_sector_ersonal_id_fecha');
            #$table->unique(['personal_id','sector_id','fecha'], 'unique_personal_sector_sector_id_personal_id_fecha');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_sector');
    }
}
