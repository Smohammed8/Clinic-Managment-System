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
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('test_name')->nullable();
            $table->text('test_desc')->nullable();
            $table->unsignedBigInteger('lab_catagory_id')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->boolean('is_available')->nullable();
            $table->decimal('price')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_tests');
    }
};
