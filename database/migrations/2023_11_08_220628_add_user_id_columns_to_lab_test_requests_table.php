<?php

use App\Models\ClinicUser;
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
            // Schema::table('lab_test_requests', function (Blueprint $table) {
            //     $table->foreignIdFor(ClinicUser::class,'doctor_id')->nullable()->constrained();
            // });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_test_requests', function (Blueprint $table) {
            //
        });
    }
};
