<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        DB::table('users')->delete();
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'name' => 'Admin Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
            ]);

        $this->call(PermissionsSeeder::class);
        // $this->call(AppointmentSeeder::class);
        $this->call(CampusSeeder::class);
         $this->call(ClinicSeeder::class);
        // $this->call(ClinicServicesSeeder::class);
        // $this->call(ClinicUserSeeder::class);
        // $this->call(CollageSeeder::class);
        // $this->call(DiagnosisSeeder::class);
        // $this->call(EncounterSeeder::class);
        $this->call(LabCatagorySeeder::class);
        // $this->call(LabTestSeeder::class);
        // $this->call(LabTestRequestSeeder::class);
        // $this->call(LabTestRequestGroupSeeder::class);
        // $this->call(MainDiagnosisSeeder::class);
        // $this->call(MedicalRecordSeeder::class);
        // $this->call(PrescriptionSeeder::class);
        // $this->call(ProgramSeeder::class);
        // $this->call(ReligionSeeder::class);
        // $this->call(RoomSeeder::class);
        // $this->call(StockSeeder::class);
        // $this->call(StockCategorySeeder::class);
        // $this->call(StockUnitSeeder::class);
        // $this->call(StudentSeeder::class);
        // $this->call(SupplierSeeder::class);
        $this->call(UserSeeder::class);
       // $this->call(VitalSignSeeder::class);
    }
}
