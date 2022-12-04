<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_exam'); //
            $table->string('quantity'); //
            $table->string('assessment'); //
            $table->string('observations_pru'); //
            $table->unsignedBigInteger('medical_consultation_id');
            $table->foreign('medical_consultation_id')->references('id')->on('medical_consultations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_tests');
    }
};
