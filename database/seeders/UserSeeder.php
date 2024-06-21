<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'no_telepon' => '081350311133',
            'status_admin' => true,
        ]);
    }
}
