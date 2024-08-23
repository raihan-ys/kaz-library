<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'name' => 'Raihan Yudi Syukma',
            'email' => 'raihanys03@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'created_at' => now(),
        ],
        [
            'name' => 'Raihan Eka Putra',
            'email' => 'eka@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'librarian',
            'created_at' => now(),
        ],
        ]);
    }
}
