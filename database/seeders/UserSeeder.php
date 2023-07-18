<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('users')->delete();
            User::create([
                'name' => 'Admin Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
            ]);
    }

}