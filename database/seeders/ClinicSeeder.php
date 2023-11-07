<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clinic::factory()
        //     ->count(5)
        //     ->create();


        DB::table('clinic')->delete();

        $clinics = [
            ['id' => 1, 'name' => 'Main-Clinic', 'description' => 'Main Campus'],
            ['id' => 2, 'name' => 'JiT-Clinic', 'description' => 'JiT'],
            ['id' => 3, 'name' => 'Agri-Clinic', 'description' => 'GAVM-Agri'],

        ];

        Clinic::insert($clinics);
    }
}
