<?php

namespace Database\Seeders;

use App\Models\Encounter;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('students')->delete();
        Student::create([
            'first_name' => 'Student',
            'middle_name' => 'One',
            'last_name' => 'One',
            'sex' => 'M',
            'photo' => null,
            'id_number' => 'RU1213/06',

            'religion_id' => null,
            'campus_id' => null,
            'program_id' => null,

            'user_id' => null,
            'nationality' => 'Ethiopian',
            'mobile_number' => '0917638874',
            //'description' => str_random(10),
            'email' => 'student@ju.edu.et',
            'date_of_birth' => Carbon::now()->format('Y-m-d H:i:s'),
            'year' => 3,
            'year_of_entrance' => 2010,
            'is_id_active' => 1,
            'is_student_active' => 1,
            'id_significant_digit' => NULL,
            'is_registered' => NULL,
            'rfid' => NULL,
            'username' => NULL,
            'academic_year' => NULL,
            'mrn' => NULL,
            'section' => NULL,
            'semester' => NULL,
            'entrance_reg_no' => NULL,
            'is_fresh_registered' => NULL,
            'phone' => NULL,
            'rfid_temp' => NULL,
            'created_at'  => Carbon::now(),
            'updated_at' => NULL


        ]);


        DB::table('encounters')->delete();
        Encounter::create([
            'check_in_time' => NULL,
            'status' => 1,
            'closed_at' => 1,
            'priority' => 1,
            'clinic_id' => 1,
            'student_id' => 1,
            'created_at' => 1,
            'updated_at' => 1,
            'doctor_id' => 1,
            'registered_by' => 1,
            'created_at'  => Carbon::now(),
            'updated_at' => NULL


        ]);
    }
}
