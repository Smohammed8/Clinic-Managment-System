<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Collage;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('departments', function (Blueprint $table) {
            $table->unsignedBigInteger('college_id')->nullable();

            $table->foreign('college_id')->references('id')->on('collage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            //
            $table->dropForeign(['college_id']);
            $table->dropColumn('college_ids');
        });
    }
};
