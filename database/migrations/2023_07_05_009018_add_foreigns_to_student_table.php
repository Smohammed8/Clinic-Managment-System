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
        // Schema::table('students', function (Blueprint $table) {
        //     $table
        //         ->foreign('encounter_id')
        //         ->references('id')
        //         ->on('encounters')
        //         ->onUpdate('CASCADE')
        //         ->onDelete('CASCADE');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('student', function (Blueprint $table) {
        //     $table->dropForeign(['encounter_id']);
        // });
    }
};
