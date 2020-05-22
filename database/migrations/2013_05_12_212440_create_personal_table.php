<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->unsignedBigInteger('id');

            $table->foreign('id')
                ->references('id')
                ->on('personas')
                ->onDelete('cascade');

            $table->unsignedBigInteger('matricula')->nullable($value = true);

            $table->timestamps();

            $table->primary(['id'], 'personal_id_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal');
    }
}
