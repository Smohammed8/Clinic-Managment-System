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
        Schema::table('encounters', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('registered_by')->nullable();

            $table->foreign('doctor_id')->references('id')->on('users')->nullable();
            $table->foreign('registered_by')->references('id')->on('users')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('encounters', function (Blueprint $table) {
            //
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['registered_by']);

            $table->dropColumn('doctor_id');
            $table->dropColumn('registered_by');
        });
    }
};
