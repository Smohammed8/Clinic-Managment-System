<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Category::factory()
            //     ->count(5)
            //     ->create();



            $categories = [
                'Reisparatory Medication',
                'Medicines for Allergies',
                'Antibiotics',
                'Antifungals',
                'Antivirals',
                'Antiprotozoals',
                'Antihelmentics',
                'Antipain',
                'Local Anesthetics',
                'VITAMINS',
                'Medicines used in Allergic Emergencies',
                'CORRECTING FLUID AND ELECTROLYTE',
                'OPHTHALMIC AGENTS',
                'EAR, NOSE AND THROAT PREPARATIONS',
                'DERMATOLOGICAL AGENTS',
                'Antiseptic agents',
                'MISCELLANEOUS',
                'Gastrointestinal Agents',
                'Antihaemorrhoidal Agents',
            ];
            $i=1;
            foreach ($categories as $category) {
                DB::table('categories')->insert([
                    'id'=>$i++,
                    'name' => $category,
                    // You can set default values for other columns if needed
                    'description' => null,
                    'status' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    }
}
