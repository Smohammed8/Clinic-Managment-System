<?php

namespace Database\Seeders;

use App\Models\LabCatagory;
use Illuminate\Database\Seeder;

class LabCatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LabCatagory::factory()
            ->count(5)
            ->create();
    }
}
