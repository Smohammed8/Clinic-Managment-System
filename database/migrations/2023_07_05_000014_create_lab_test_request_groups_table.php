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
        Schema::create('lab_test_request_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('priority')->nullable();
            $table->tinyInteger('notification')->nullable();
            $table->tinyInteger('call_status')->nullable();
            $table->dateTime('requested_at')->nullable();
            $table->unsignedBigInteger('clinic_user_id')->nullable();
            $table->unsignedBigInteger('encounter_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_test_request_groups');
    }
};
