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
        Schema::table('main_diagnoses', function (Blueprint $table) {
            $table
                ->foreign('clinic_user_id')
                ->references('id')
                ->on('clinic_users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('encounter_id')
                ->references('id')
                ->on('encounters')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('diagnosis_id')
                ->references('id')
                ->on('diagnoses')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main_diagnoses', function (Blueprint $table) {
            $table->dropForeign(['clinic_user_id']);
            $table->dropForeign(['student_id']);
            $table->dropForeign(['encounter_id']);
            $table->dropForeign(['diagnosis_id']);
        });
    }
};
