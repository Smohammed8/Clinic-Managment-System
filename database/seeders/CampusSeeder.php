<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('campus')->delete();
       $campuses = [
          ['id' => 1, 'name' => 'Main Campus', 'description' => 'Main Campus'],
          ['id' => 2, 'name' => 'JiT', 'description' => 'JiT'],
          ['id' => 3, 'name' => 'GAVM-Agri', 'description' => 'GAVM-Agri'],
          ['id' => 4, 'name' => 'Agaro', 'description' => 'Agaro'],
      ];
  
      Campus::insert($campuses);
    }

}
