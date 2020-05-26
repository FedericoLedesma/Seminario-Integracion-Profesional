<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('racion', function (Blueprint $table) {
            $table->bigIncrements('id');
            #$table->string('name',50);
            $table->string('name');
            $table->string('observacion',100)->nullable();
            $table->timestamps();

			#$table->primary(['id'],'primary_key_racion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raciones');
    }
}
