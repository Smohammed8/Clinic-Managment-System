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

        // findOrCreate default permissions
        Permission::create(['name' => 'list appointments']);
        Permission::create(['name' => 'view appointments']);
        Permission::create(['name' => 'create appointments']);
        Permission::create(['name' => 'update appointments']);
        Permission::create(['name' => 'delete appointments']);

        Permission::create(['name' => 'list campuses']);
        Permission::create(['name' => 'view campuses']);
        Permission::create(['name' => 'create campuses']);
        Permission::create(['name' => 'update campuses']);
        Permission::create(['name' => 'delete campuses']);

        Permission::create(['name' => 'list clinics']);
        Permission::create(['name' => 'view clinics']);
        Permission::create(['name' => 'create clinics']);
        Permission::create(['name' => 'update clinics']);
        Permission::create(['name' => 'delete clinics']);

        Permission::create(['name' => 'list allclinicservices']);
        Permission::create(['name' => 'view allclinicservices']);
        Permission::create(['name' => 'create allclinicservices']);
        Permission::create(['name' => 'update allclinicservices']);
        Permission::create(['name' => 'delete allclinicservices']);

        Permission::create(['name' => 'list clinicusers']);
        Permission::create(['name' => 'view clinicusers']);
        Permission::create(['name' => 'create clinicusers']);
        Permission::create(['name' => 'update clinicusers']);
        Permission::create(['name' => 'delete clinicusers']);

        Permission::create(['name' => 'list collages']);
        Permission::create(['name' => 'view collages']);
        Permission::create(['name' => 'create collages']);
        Permission::create(['name' => 'update collages']);
        Permission::create(['name' => 'delete collages']);

        Permission::create(['name' => 'list diagnoses']);
        Permission::create(['name' => 'view diagnoses']);
        Permission::create(['name' => 'create diagnoses']);
        Permission::create(['name' => 'update diagnoses']);
        Permission::create(['name' => 'delete diagnoses']);

        Permission::create(['name' => 'list encounters']);
        Permission::create(['name' => 'view encounters']);
        Permission::create(['name' => 'create encounters']);
        Permission::create(['name' => 'update encounters']);
        Permission::create(['name' => 'delete encounters']);

        Permission::create(['name' => 'list labcatagories']);
        Permission::create(['name' => 'view labcatagories']);
        Permission::create(['name' => 'create labcatagories']);
        Permission::create(['name' => 'update labcatagories']);
        Permission::create(['name' => 'delete labcatagories']);

        Permission::create(['name' => 'list labtests']);
        Permission::create(['name' => 'view labtests']);
        Permission::create(['name' => 'create labtests']);
        Permission::create(['name' => 'update labtests']);
        Permission::create(['name' => 'delete labtests']);

        Permission::create(['name' => 'list labtestrequests']);
        Permission::create(['name' => 'view labtestrequests']);
        Permission::create(['name' => 'create labtestrequests']);
        Permission::create(['name' => 'update labtestrequests']);
        Permission::create(['name' => 'delete labtestrequests']);

        Permission::create(['name' => 'list labtestrequestgroups']);
        Permission::create(['name' => 'view labtestrequestgroups']);
        Permission::create(['name' => 'create labtestrequestgroups']);
        Permission::create(['name' => 'update labtestrequestgroups']);
        Permission::create(['name' => 'delete labtestrequestgroups']);

        Permission::create(['name' => 'list maindiagnoses']);
        Permission::create(['name' => 'view maindiagnoses']);
        Permission::create(['name' => 'create maindiagnoses']);
        Permission::create(['name' => 'update maindiagnoses']);
        Permission::create(['name' => 'delete maindiagnoses']);

        Permission::create(['name' => 'list medicalrecords']);
        Permission::create(['name' => 'view medicalrecords']);
        Permission::create(['name' => 'create medicalrecords']);
        Permission::create(['name' => 'update medicalrecords']);
        Permission::create(['name' => 'delete medicalrecords']);

        Permission::create(['name' => 'list prescriptions']);
        Permission::create(['name' => 'view prescriptions']);
        Permission::create(['name' => 'create prescriptions']);
        Permission::create(['name' => 'update prescriptions']);
        Permission::create(['name' => 'delete prescriptions']);

        Permission::create(['name' => 'list programs']);
        Permission::create(['name' => 'view programs']);
        Permission::create(['name' => 'create programs']);
        Permission::create(['name' => 'update programs']);
        Permission::create(['name' => 'delete programs']);

        Permission::create(['name' => 'list religions']);
        Permission::create(['name' => 'view religions']);
        Permission::create(['name' => 'create religions']);
        Permission::create(['name' => 'update religions']);
        Permission::create(['name' => 'delete religions']);

        Permission::create(['name' => 'list rooms']);
        Permission::create(['name' => 'view rooms']);
        Permission::create(['name' => 'create rooms']);
        Permission::create(['name' => 'update rooms']);
        Permission::create(['name' => 'delete rooms']);

        Permission::create(['name' => 'list stocks']);
        Permission::create(['name' => 'view stocks']);
        Permission::create(['name' => 'create stocks']);
        Permission::create(['name' => 'update stocks']);
        Permission::create(['name' => 'delete stocks']);

        Permission::create(['name' => 'list stockcategories']);
        Permission::create(['name' => 'view stockcategories']);
        Permission::create(['name' => 'create stockcategories']);
        Permission::create(['name' => 'update stockcategories']);
        Permission::create(['name' => 'delete stockcategories']);

        Permission::create(['name' => 'list stockunits']);
        Permission::create(['name' => 'view stockunits']);
        Permission::create(['name' => 'create stockunits']);
        Permission::create(['name' => 'update stockunits']);
        Permission::create(['name' => 'delete stockunits']);

        Permission::create(['name' => 'list students']);
        Permission::create(['name' => 'view students']);
        Permission::create(['name' => 'create students']);
        Permission::create(['name' => 'update students']);
        Permission::create(['name' => 'delete students']);

        Permission::create(['name' => 'list suppliers']);
        Permission::create(['name' => 'view suppliers']);
        Permission::create(['name' => 'create suppliers']);
        Permission::create(['name' => 'update suppliers']);
        Permission::create(['name' => 'delete suppliers']);

        Permission::create(['name' => 'list vitalsigns']);
        Permission::create(['name' => 'view vitalsigns']);
        Permission::create(['name' => 'create vitalsigns']);
        Permission::create(['name' => 'update vitalsigns']);
        Permission::create(['name' => 'delete vitalsigns']);
        Permission::findOrCreate('view-dashboard');

        // findOrCreate user role and assign existing permissions
        $currentPermissions = Permission::all();
        ///////////////////////////////////////////////////////

        $userRole = Role::create(['name' => 'user']);
        $doctorRole = Role::create(['name' => DOCTOR_ROLE]);
        $labTechnicianRole = Role::create(['name' => 'lab_technician']);
        $receptionRole = Role::create(['name' => 'reception']);
        $pharmacyRole = Role::create(['name' => 'pharmacist']);
        $physicianRole = Role::create(['name' => 'physician']);
        $nurseRole = Role::create(['name' => 'nurse']);

        // $userRole->givePermissionTo($currentPermissions);
        // $labTechnicianRole->givePermissionTo($currentPermissions);
        // $receptionRole->givePermissionTo($currentPermissions);
        // $pharmacyRole->givePermissionTo($currentPermissions);
        // $physicianRole->givePermissionTo($currentPermissions);
        // $nurseRole->givePermissionTo($currentPermissions);
        ///////////////////////////////////////////////////////////////////////////
        // findOrCreate admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // findOrCreate admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $adminUser = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }


        $doctorUser = \App\Models\User::whereEmail('doctor@doctor.com')->first();
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
        $store_user->syncPermissions('store.product.*', 'store.product.index', 'store.product.create', 'store.product.update', 'store.product.view', 'store.product.item', 'store.request.*', 'store.request.index', 'store.request.approve', 'store.request.reject', 'store.records.*', 'store.records.index', 'store.records.view', 'store.records.edit', 'store.records.delete');

        $pharmacy_user = Role::findOrCreate(Constants::PHARMACY_USER);
        $pharmacy_user->syncPermissions('pharmacy.prescriptions.*', 'pharmacy.prescriptions.index', 'pharmacy.prescriptions.approve', 'pharmacy.prescriptions.view', 'pharmacy.products.*', 'pharmacy.products.index', 'pharmacy.products.request', 'pharmacy.products.view', 'pharmacy.history.*');

        // $doctorRole->syncPermissions([
        //     'list appointments',
        //     'view appointments',
        //     'create appointments',
        //     'update appointments',
        //     'delete appointments',

        //     'list encounters',
        //     'view encounters',
        //     'create encounters',
        //     'update encounters',
        //     'delete encounters',

        //     'list labtests',
        //     'view labtests',
        //     'create labtests',
        //     'update labtests',
        //     'delete labtests',

        //     'list prescriptions',
        //     'view prescriptions',
        //     'create prescriptions',
        //     'update prescriptions',
        //     'delete prescriptions',

        //     'list medicalrecords',
        //     'view medicalrecords',
        //     'create medicalrecords',
        //     'update medicalrecords',
        //     'delete medicalrecords',

        //     'list vitalsigns',
        //     'view vitalsigns',
        //     'create vitalsigns',
        //     'update vitalsigns',
        //     'delete vitalsigns',

        //     'list diagnoses',
        //     'view diagnoses',
        //     'create diagnoses',
        //     'update diagnoses',
        //     'delete diagnoses',

        //     'list labtestrequests',
        //     'view labtestrequests',
        //     'create labtestrequests',
        //     'update labtestrequests',
        //     'delete labtestrequests',

        //     'list maindiagnoses',
        //     'view maindiagnoses',
        //     'create maindiagnoses',
        //     'update maindiagnoses',
        //     'delete maindiagnoses'
        // ]);
    }
}
