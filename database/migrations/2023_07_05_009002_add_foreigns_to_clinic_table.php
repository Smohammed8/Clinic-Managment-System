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
        Schema::table('clinic', function (Blueprint $table) {
            $table
                ->foreign('campus_id')
                ->references('id')
                ->on('campus')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('collage_id')
                ->references('id')
                ->on('collage')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clinic', function (Blueprint $table) {
            $table->dropForeign(['campus_id']);
            $table->dropForeign(['collage_id']);
        });
    }
};
