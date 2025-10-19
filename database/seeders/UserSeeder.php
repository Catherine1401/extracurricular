<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'huy',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'vu',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Tổ chức ABC',
            'email' => 'org@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'organization',
        ]);

        User::create([
            'name' => 'Tổ chức XYZ',
            'email' => 'org2@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'organization',
        ]);
    }
}
