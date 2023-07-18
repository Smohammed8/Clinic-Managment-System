<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('batch_number')->nullable();
            $table->date('expire_date')->nullable();
            $table->string('brand')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('campany_name')->nullable();
            $table->decimal('number_of_units')->nullable();
            $table->decimal('number_of_unit_per_pack')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('price_per_unit')->nullable();
            $table->double('profit_margit')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
