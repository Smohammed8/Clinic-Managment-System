<?php

namespace Database\Seeders;

use App\Models\Collage;
use Illuminate\Database\Seeder;

class CollageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Collage::factory()
            ->count(5)
            ->create();
    }
}
