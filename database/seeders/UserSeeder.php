<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'email'=>'admin@admin.com',
                'password'=> bcrypt('password'),
                'is_admin'=>true,
            ]
        );
        User::firstOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'User',
                'email'=>'user@user.com',
                'password'=> bcrypt('password'),
                'is_admin'=>false,
            ]
        );
    }
}
