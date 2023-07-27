<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductResponse;

class ProductResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductResponse::factory()
            ->count(5)
            ->create();
    }
}
