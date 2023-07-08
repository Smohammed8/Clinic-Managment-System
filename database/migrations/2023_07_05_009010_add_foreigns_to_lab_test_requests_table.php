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
        Schema::table('lab_test_requests', function (Blueprint $table) {
            $table
                ->foreign('lab_test_request_group_id')
                ->references('id')
                ->on('lab_test_request_groups')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('sample_collected_by_id')
                ->references('id')
                ->on('clinic_users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('sample_analyzed_by_id')
                ->references('id')
                ->on('clinic_users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('lab_catagory_id')
                ->references('id')
                ->on('lab_catagories')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('approved_by_id')
                ->references('id')
                ->on('clinic_users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lab_test_requests', function (Blueprint $table) {
            $table->dropForeign(['lab_test_request_group_id']);
            $table->dropForeign(['sample_collected_by_id']);
            $table->dropForeign(['sample_analyzed_by_id']);
            $table->dropForeign(['lab_catagory_id']);
            $table->dropForeign(['approved_by_id']);
        });
    }
};
