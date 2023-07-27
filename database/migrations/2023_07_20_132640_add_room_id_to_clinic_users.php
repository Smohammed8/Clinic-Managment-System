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
        Schema::table('clinic_users', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('room_id')->nullable();

            // Add the foreign key constraint
            $table->foreign('room_id')->references('id')->on('room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinic_users', function (Blueprint $table) {
            //
            $table->dropForeign(['room_id']);

            // Drop the room_id column
            $table->dropColumn('room_id');
        });
    }
};
