<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
            Campus::firstOrCreate([
                'name' => 'Main Campus'
            ], [
                'name' => 'Main Campus'
            ]);
            Campus::firstOrCreate([
                'name' => 'Agri Campus'
            ], [
                'name' => 'Agri Campus'
            ]);
            Campus::firstOrCreate([
                'name' => 'JIT Campus'
            ], [
                'name' => 'JIT Campus'
            ]);
            Campus::firstOrCreate([
                'name' => 'Agaro Campus'
            ], [
                'name' => 'Agaro Campus'
            ]);
            Campus::firstOrCreate([
                'name' => 'Beco Campus'
            ], [
                'name' => 'Beco Campus'
            ]);
            $this->call(PermissionsSeeder::class);

            $this->call(AppointmentSeeder::class);
            $this->call(CampusSeeder::class);
            $this->call(CategorySeeder::class);
            $this->call(ClinicSeeder::class);
            $this->call(ClinicServicesSeeder::class);
            $this->call(ClinicUserSeeder::class);
            $this->call(CollageSeeder::class);
            $this->call(DiagnosisSeeder::class);
            $this->call(EncounterSeeder::class);
            $this->call(ItemSeeder::class);
            $this->call(ItemRequestSeeder::class);
            $this->call(ItemsInPharmacySeeder::class);
            $this->call(LabCatagorySeeder::class);
            $this->call(LabTestSeeder::class);
            $this->call(LabTestRequestSeeder::class);
            $this->call(LabTestRequestGroupSeeder::class);
            $this->call(MainDiagnosisSeeder::class);
            $this->call(MedicalRecordSeeder::class);
            $this->call(PharmacySeeder::class);
            // $this->call(PharmacyUserSeeder::class);
            $this->call(PrescriptionSeeder::class);
            $this->call(ProductSeeder::class);
            $this->call(ProductRequestSeeder::class);
            // $this->call(ProductResponseSeeder::class);
            $this->call(ProgramSeeder::class);
            $this->call(ReligionSeeder::class);
            $this->call(RoomSeeder::class);
            $this->call(StockSeeder::class);
            $this->call(StockCategorySeeder::class);
            $this->call(StockUnitSeeder::class);
            $this->call(StoreSeeder::class);
            $this->call(StoresToPharmacySeeder::class);
            // $this->call(StoreUserSeeder::class);
            $this->call(StudentSeeder::class);
            $this->call(SupplierSeeder::class);
            $this->call(UserSeeder::class);
            $this->call(VitalSignSeeder::class);
    }
}
