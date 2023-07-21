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
            $table->unsignedBigInteger('encounter_id')->nullable();

            // Add the foreign key constraint
            $table->foreign('encounter_id')
                ->references('id')
                ->on('encounters')
                ->onDelete('cascade');
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
            $table->dropForeign(['encounter_id']);

            $table->dropColumn('encounter_id');
        });
    }
};
