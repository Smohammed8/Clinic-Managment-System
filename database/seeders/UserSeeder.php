<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use App\Models\Clinic;
use App\Models\ClinicUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'doctor', 'reception', 'laboratory', 'pharmacy', 'store'];

        DB::table('users')->delete();
        foreach ($roles as $role) {
            User::create([
                'name' => ucfirst($role) . ' User',
                'username' => $role,
                'email' => $role . '@' . $role . '.com',
                'password' => Hash::make('password'),
            ]);
        }


        DB::table('clinic')->delete();

        $clinics = [
            ['id' => 1, 'name' => 'Main-Clinic', 'description' => 'Main Campus'],
            ['id' => 2, 'name' => 'JiT-Clinic', 'description' => 'JiT'],
            ['id' => 3, 'name' => 'Agri-Clinic', 'description' => 'GAVM-Agri'],

        ];

        Clinic::insert($clinics);



        DB::table('room')->delete();
        Room::create([
            'name' => 'OPD 001',
            'description' => '',
            'clinic_id' => 1,
        ]);
        DB::table('clinic_users')->delete();

        $i = 2;
        foreach ($roles as $role) {
            ClinicUser::create([
                'user_id' => $i,
                'room_id' => 1,
            ]);
            $i++;
        }
    }
}
