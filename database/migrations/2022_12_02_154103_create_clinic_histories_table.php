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
        Schema::create('clinic_histories', function (Blueprint $table) {
            $table->id();
            $table->text('personal_history'); //  Antecedentes Personales
            $table->text('family_background'); // Antecedentes Familiares
            $table->text('current_illness'); // Enfermedad Actual
            $table->text('habits'); //Habitos
            $table->unsignedBigInteger('person_id')->unique();
            $table->foreign('person_id')->references('id')->on('persons');
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
        Schema::dropIfExists('clinic_histories');
    }
};
