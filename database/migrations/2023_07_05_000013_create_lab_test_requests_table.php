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
        Schema::create('lab_test_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('sample_collected_at')->nullable();
            $table->dateTime('sample_analyzed_at')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('notification')->nullable();
            $table->text('note')->nullable();
            $table->text('result')->nullable();
            $table->text('comment')->nullable();
            $table->string('analyser_result')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->decimal('price')->nullable();
            $table->string('sample_id')->nullable();
            $table->dateTime('ordered_on')->nullable();
            $table->unsignedBigInteger('lab_test_request_group_id')->nullable();
            $table->unsignedBigInteger('sample_collected_by_id')->nullable();
            $table->unsignedBigInteger('sample_analyzed_by_id')->nullable();
            $table->unsignedBigInteger('lab_catagory_id')->nullable();
            $table->unsignedBigInteger('approved_by_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_test_requests');
    }
};
