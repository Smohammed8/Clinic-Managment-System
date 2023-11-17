<?php

namespace Database\Seeders;

use App\Models\Campus;
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
        $this->call(CampusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionsSeeder::class);


    }
}
