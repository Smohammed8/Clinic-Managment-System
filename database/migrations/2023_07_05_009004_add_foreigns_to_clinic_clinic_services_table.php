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
        Schema::table('clinic_clinic_services', function (Blueprint $table) {
            $table
                ->foreign('clinic_id')
                ->references('id')
                ->on('clinic')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('clinic_services_id')
                ->references('id')
                ->on('clinic_services')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clinic_clinic_services', function (Blueprint $table) {
            $table->dropForeign(['clinic_id']);
            $table->dropForeign(['clinic_services_id']);
        });
    }
};
