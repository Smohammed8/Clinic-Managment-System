<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabTestRequestGroup;

class LabTestRequestGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LabTestRequestGroup::factory()
            ->count(5)
            ->create();
    }
}
