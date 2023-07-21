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
        Schema::table('medical_sick_leaves', function (Blueprint $table) {
            //
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('clinic_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_sick_leaves', function (Blueprint $table) {
            //
            $table->dropForeign(['student_id']);
            $table->dropForeign(['doctor_id']);
        });
    }
};
