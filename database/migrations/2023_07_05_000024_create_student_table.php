<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();;
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->string('photo')->nullable();
            $table->string('id_number')->nullable();;
            $table->integer('religion_id')->nullable();
            $table->integer('campus_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('nationality')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('year')->nullable();;
            $table->string('year_of_entrance')->nullable();
            $table->boolean('is_id_active')->nullable();
            $table->boolean('is_student_active')->nullable();
            $table->integer('id_significant_digit')->nullable();
            $table->boolean('is_registered')->nullable();
            $table->string('rfid', 10)->nullable();
            $table->string('username')->nullable();
            $table->string('academic_year')->nullable();
            $table->string('mrn')->nullable();
            $table->integer('section')->nullable();
            $table->integer('semester')->nullable();
            $table->string('entrance_reg_no')->nullable();
            $table->boolean('is_fresh_registered')->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('rfid_temp', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
