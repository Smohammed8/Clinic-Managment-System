<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
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

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        ///////////////////////////////////////////////////////
    
        $userRole = Role::create(['name' => 'user']);
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
        // Create admin exclusive permissions
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

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
