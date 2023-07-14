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
        Schema::table('medical_records', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('vital_sign_id')->nullable();

            $table->foreign('vital_sign_id')->references('id')->on('vital_signs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_records', function (Blueprint $table) {
            //
            $table->dropForeign(['vital_sign_id']);
            $table->dropColumn('vital_sign_id');
        });
    }
};
