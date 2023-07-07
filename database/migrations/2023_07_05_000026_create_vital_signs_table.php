<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('temp')->nullable();
            $table->decimal('blood_pressure')->nullable();
            $table->decimal('pulse_rate')->nullable();
            $table->decimal('rr')->nullable();
            $table->decimal('weight')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('muac')->nullable();
            $table->unsignedBigInteger('encounter_id');
            $table->unsignedBigInteger('clinic_user_id');
            $table->unsignedBigInteger('student_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vital_signs');
    }
};
