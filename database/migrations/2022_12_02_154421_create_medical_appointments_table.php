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
        Schema::create('medical_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('description');

            $table->unsignedBigInteger('specialty_id');

            $table->unsignedBigInteger('doctor_id');

            $table->unsignedBigInteger('patient_id');

            $table->unsignedBigInteger('clinic_history_id');
            $table->foreign('clinic_history_id')->references('id')->on('clinic_histories');

            $table->string('cancellation_justification')->nullable();

            $table->unsignedBigInteger('cancelled_by_id')->nullable(); // Columna Renombrada

            $table->date('schedule_date');
            $table->time('schedule_time');

            $table->string('type');

            $table->string('status')->default('Reservada'); //Esta estaba como un añadido

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
        Schema::dropIfExists('medical_appointments');
    }
};
