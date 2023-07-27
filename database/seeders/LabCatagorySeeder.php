<?php

namespace Database\Seeders;

use App\Models\LabCatagory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabCatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('lab_catagories')->delete();
            $labCatagories = [
                ['id' => 1, 'lab_name' => 'Hematology & Immunohematology', 'lab_desc' => 'Hematology & Immunohematology'],
                ['id' => 2, 'lab_name' => 'Clinical Chemistry', 'lab_desc' => 'Clinical Chemistry'],
                ['id' => 3, 'lab_name' => 'Parasitology', 'lab_desc' => 'Parasitology'],
                ['id' => 4, 'lab_name' => 'Serological tests', 'lab_desc' => 'Serological tests'],
                ['id' => 5, 'lab_name' => 'Bacterology(Microbiology)', 'lab_desc' => 'Bacterology(Microbiology)'],
                ['id' => 6, 'lab_name' => 'Hormonal Assay', 'lab_desc' => 'Hormonal Assay'],
                ['id' => 7, 'lab_name' => 'Body Fluid Analysis', 'lab_desc' => 'Body Fluid Analysis']
            ];
        
            LabCatagory::insert($labCatagories);

    }



}
