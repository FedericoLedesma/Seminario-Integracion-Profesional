<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalHasProfesionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_has_profesions', function (Blueprint $table) {
            $table->unsignedBigInteger('personal_id');
            $table->unsignedInteger('profesion_id');

            $table->foreign('personal_id')
                ->references('id')
                ->on('personals')
                ->onDelete('cascade');

            $table->foreign('profesion_id')
                ->references('id')
                ->on('profesions')
                ->onDelete('cascade');

            $table->primary(['personal_id','profesion_id'], 'personal_has_profesions_personal_id_profesion_id_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_has_profesions');
    }
}
