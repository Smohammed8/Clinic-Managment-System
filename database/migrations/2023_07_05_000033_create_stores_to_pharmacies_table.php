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
        Schema::create('stores_to_pharmacies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pharmacy_id');
            $table->unsignedBigInteger('store_id');

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
        Schema::dropIfExists('stores_to_pharmacies');
    }
};
