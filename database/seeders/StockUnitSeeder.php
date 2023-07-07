<?php

namespace Database\Seeders;

use App\Models\StockUnit;
use Illuminate\Database\Seeder;

class StockUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StockUnit::factory()
            ->count(5)
            ->create();
    }
}
