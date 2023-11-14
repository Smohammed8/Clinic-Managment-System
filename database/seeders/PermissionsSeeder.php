<?php

namespace Database\Seeders;

use App\Constants;
use Illuminate\Database\Seeder;
use PHPUnit\TextUI\XmlConfiguration\Constant;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

require_once app_path('Helper/constants.php');


class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'list appointments', 'view appointments', 'create appointments', 'update appointments', 'delete appointments',
            'list campuses', 'view campuses', 'create campuses', 'update campuses', 'delete campuses',
            'list clinics', 'view clinics', 'create clinics', 'update clinics', 'delete clinics',
            'list allclinicservices', 'view allclinicservices', 'create allclinicservices', 'update allclinicservices', 'delete allclinicservices',
            'list clinicusers', 'view clinicusers', 'create clinicusers', 'update clinicusers', 'delete clinicusers',
            'list collages', 'view collages', 'create collages', 'update collages', 'delete collages',
            'list diagnoses', 'view diagnoses', 'create diagnoses', 'update diagnoses', 'delete diagnoses',
            'list encounters', 'view encounters', 'create encounters', 'update encounters', 'delete encounters',
            'list labcatagories', 'view labcatagories', 'create labcatagories', 'update labcatagories', 'delete labcatagories',
            'list labtests', 'view labtests', 'create labtests', 'update labtests', 'delete labtests',
            'list labtestrequests', 'view labtestrequests', 'create labtestrequests', 'update labtestrequests', 'delete labtestrequests',
            'list labtestrequestgroups', 'view labtestrequestgroups', 'create labtestrequestgroups', 'update labtestrequestgroups', 'delete labtestrequestgroups',
            'list maindiagnoses', 'view maindiagnoses', 'create maindiagnoses', 'update maindiagnoses', 'delete maindiagnoses',
            'list medicalrecords', 'view medicalrecords', 'create medicalrecords', 'update medicalrecords', 'delete medicalrecords',
            'list prescriptions', 'view prescriptions', 'create prescriptions', 'update prescriptions', 'delete prescriptions',
            'list programs', 'view programs', 'create programs', 'update programs', 'delete programs',
            'list religions', 'view religions', 'create religions', 'update religions', 'delete religions',
            'list rooms', 'view rooms', 'create rooms', 'update rooms', 'delete rooms',
            'list stocks', 'view stocks', 'create stocks', 'update stocks', 'delete stocks',
            'list stockcategories', 'view stockcategories', 'create stockcategories', 'update stockcategories', 'delete stockcategories',
            'list stockunits', 'view stockunits', 'create stockunits', 'update stockunits', 'delete stockunits',
            'list students', 'view students', 'create students', 'update students', 'delete students',
            'list suppliers', 'view suppliers', 'create suppliers', 'update suppliers', 'delete suppliers',
            'list vitalsigns', 'view vitalsigns', 'create vitalsigns', 'update vitalsigns', 'accept_patient', 'list videos', 'view videos', 'create videos', 'update videos', 'delete videos'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }



        Permission::findOrCreate('delete vitalsigns');
        Permission::findOrCreate('view-dashboard');
        Permission::findOrCreate('view-dashboard');
        Permission::findOrCreate('sync-student');
        Permission::findOrCreate('sync-photo');
        Permission::findOrCreate('patient-checkin');
        Permission::findOrCreate('view_lab_waiting');
        Permission::findOrCreate('waiting-queue');
        Permission::findOrCreate('view-lab-dispay');
        Permission::findOrCreate('view-OPD-dispay');
        Permission::findOrCreate('view-setting');
        Permission::findOrCreate('accept_patient');


        // findOrCreate user role and assign existing permissions
        $currentPermissions = Permission::all();
        ///////////////////////////////////////////////////////

        $userRole = Role::updateOrCreate(['name' => 'user']);
        $doctorRole = Role::updateOrCreate(['name' => DOCTOR_ROLE]);
        $labTechnicianRole = Role::updateOrCreate(['name' => 'lab_technician']);
        $receptionRole = Role::updateOrCreate(['name' => 'reception']);
        $pharmacyRole = Role::updateOrCreate(['name' => 'pharmacist']);
        $physicianRole = Role::updateOrCreate(['name' => 'physician']);
        $nurseRole = Role::updateOrCreate(['name' => 'nurse']);


        // findOrCreate admin exclusive permissions
        Permission::firstOrCreate(['name' => 'list roles']);
        Permission::firstOrCreate(['name' => 'view roles']);
        Permission::firstOrCreate(['name' => 'create roles']);
        Permission::firstOrCreate(['name' => 'update roles']);
        Permission::firstOrCreate(['name' => 'delete roles']);

        Permission::firstOrCreate(['name' => 'list permissions']);
        Permission::firstOrCreate(['name' => 'view permissions']);
        Permission::firstOrCreate(['name' => 'create permissions']);
        Permission::firstOrCreate(['name' => 'update permissions']);
        Permission::firstOrCreate(['name' => 'delete permissions']);

        Permission::firstOrCreate(['name' => 'list users']);
        Permission::firstOrCreate(['name' => 'view users']);
        Permission::firstOrCreate(['name' => 'create users']);
        Permission::firstOrCreate(['name' => 'update users']);
        Permission::firstOrCreate(['name' => 'delete users']);


        // Check if the 'super-admin' role already exists
        $adminRole = Role::where('name', 'super-admin')->first();

        // If the 'super-admin' role doesn't exist, create it
        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'super-admin']);

            // Give the 'super-admin' role all permissions
            $allPermissions = Permission::all();
            $adminRole->givePermissionTo($allPermissions);
        }

        // Check if the admin user already exists
        $adminUser = \App\Models\User::whereEmail('admin@admin.com')->first();

        // If the admin user doesn't exist, create it and assign the 'super-admin' role
        if (!$adminUser) {
            $adminUser = \App\Models\User::create([
                'email' => 'admin@admin.com',
                // Add other user details as needed
            ]);

            $adminUser->assignRole($e);
        }

        // Similar checks for the doctor user
        $doctorUser = \App\Models\User::whereEmail('doctor@doctor.com')->first();

        if (!$doctorUser) {
            $doctorUser = \App\Models\User::create([
                'email' => 'doctor@doctor.com',
                // Add other user details as needed
            ]);

            // Assign roles to the doctor user if needed
        }

        $permissionsForDoctor = [
            'list appointments',
            'create appointments',
            'update appointments',
            'delete appointments',
            'list encounters',
            'view encounters',
            'create encounters',
            'update encounters',
            'delete encounters',
            'list diagnoses',
            'view diagnoses',
            'create diagnoses',
            'update diagnoses',
            'delete diagnoses',
            'list labtests',
            'view labtests',
            'create labtests',
            'update labtests',
            'delete labtests',
            'list prescriptions',
            'view prescriptions',
            'create prescriptions',
            'update prescriptions',
            'delete prescriptions',
            'list medicalrecords',
            'view medicalrecords',
            'create medicalrecords',
            'update medicalrecords',
            'delete medicalrecords',
            'list vitalsigns',
            'view vitalsigns',
            'create vitalsigns',
            'update vitalsigns',
            'delete vitalsigns',
            // Add other doctor-specific permissions here
        ];
        $doctorRole->givePermissionTo($permissionsForDoctor);

        if ($doctorUser) {

            $doctorUser->assignRole($doctorRole);
        }

        $permissionsForReception = [
            'list appointments',
            'view appointments',
            'create appointments',
            'update appointments',
            'delete appointments',
            'list encounters',
            'view encounters',
            'create encounters',
            'update encounters',
            'delete encounters',
            // Add other reception-specific permissions here
        ];
        $receptionRole->givePermissionTo($permissionsForReception);

        $receptionUser = \App\Models\User::whereEmail('reception@reception.com')->first();

        if ($receptionUser) {
            $receptionUser->assignRole($receptionRole);
        }


        Permission::findOrCreate('store.*');
        Permission::findOrCreate('store.product.*');
        Permission::findOrCreate('store.product.index');
        Permission::findOrCreate('store.product.create');
        Permission::findOrCreate('store.product.update');
        Permission::findOrCreate('store.product.view');
        Permission::findOrCreate('store.product.item');
        Permission::findOrCreate('store.request.*');
        Permission::findOrCreate('store.request.index');
        Permission::findOrCreate('store.request.approve');
        Permission::findOrCreate('store.request.reject');
        Permission::findOrCreate('store.records.*');
        Permission::findOrCreate('store.records.index');
        Permission::findOrCreate('store.records.edit');
        Permission::findOrCreate('store.records.view');
        Permission::findOrCreate('store.records.delete');
        Permission::findOrCreate('pharmacy.*');
        Permission::findOrCreate('pharmacy.prescriptions.*');
        Permission::findOrCreate('pharmacy.prescriptions.index');
        Permission::findOrCreate('pharmacy.prescriptions.approve');
        Permission::findOrCreate('pharmacy.prescriptions.view');
        Permission::findOrCreate('pharmacy.products.*');
        Permission::findOrCreate('pharmacy.products.index');
        Permission::findOrCreate('pharmacy.products.*');
        Permission::findOrCreate('pharmacy.products.index');
        Permission::findOrCreate('pharmacy.products.request');
        Permission::findOrCreate('pharmacy.products.view');
        Permission::findOrCreate('pharmacy.history.*');





        $store_user = Role::findOrCreate(Constants::STORE_USER_ROLE);
        $store_user->syncPermissions('store.*', 'store.product.*', 'store.product.index', 'store.product.create', 'store.product.update', 'store.product.view', 'store.product.item', 'store.request.*', 'store.request.index', 'store.request.approve', 'store.request.reject', 'store.records.*', 'store.records.index', 'store.records.view', 'store.records.edit', 'store.records.delete');

        $pharmacy_user = Role::findOrCreate(Constants::PHARMACY_USER);
        $pharmacy_user->syncPermissions('pharmacy.*', 'pharmacy.prescriptions.*', 'pharmacy.prescriptions.index', 'pharmacy.prescriptions.approve', 'pharmacy.prescriptions.view', 'pharmacy.products.*', 'pharmacy.products.index', 'pharmacy.products.request', 'pharmacy.products.view', 'pharmacy.history.*');
    }
}
