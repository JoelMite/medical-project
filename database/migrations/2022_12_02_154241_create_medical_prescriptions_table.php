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
        Schema::create('medical_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->text('description'); //
            $table->text('posology'); //
            $table->text('observations_pres'); //
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
        Schema::dropIfExists('medical_prescriptions');
    }
};
