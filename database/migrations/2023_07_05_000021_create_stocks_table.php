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
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('quantitiy_recived')->nullable();
            $table->string('quantity_despensed')->nullable();
            $table->string('bach_no')->nullable();
            $table->dateTime('expire_date')->nullable();
            $table->string('pack')->nullable();
            $table->string('quantity_per_pack')->nullable();
            $table->string('basic_unit_quantity')->nullable();
            $table->string('pack_price')->nullable();
            $table->unsignedBigInteger('stock_category_id')->nullable();
            $table->unsignedBigInteger('stock_unit_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
