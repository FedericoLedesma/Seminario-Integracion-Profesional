<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dieta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('patologia_id')->nullable($value = true);
            $table->string('observacion', 100);
            $table->unsignedBigInteger('personal_id');
            $table->timestamps();

			#$table->primary(['id'],'primary_key_dieta');

            $table->foreign('patologia_id')
                ->references('id')
                ->on('patologia')
                ->onDelete('cascade');

            $table->foreign('personal_id')
                ->references('id')
                ->on('personal')
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
        Schema::dropIfExists('dietas');
    }
}
