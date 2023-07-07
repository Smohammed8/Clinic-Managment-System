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
        Schema::table('room', function (Blueprint $table) {
            $table
                ->foreign('clinic_id')
                ->references('id')
                ->on('clinic')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('encounter_id')
                ->references('id')
                ->on('encounters')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room', function (Blueprint $table) {
            $table->dropForeign(['clinic_id']);
            $table->dropForeign(['encounter_id']);
        });
    }
};
