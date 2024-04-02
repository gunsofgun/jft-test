<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('Password123*'),
            'role' => 'superadmin',
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123NG*'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Gunawan',
            'email' => 'gun@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'package' => '1'
        ]);
    }
}
