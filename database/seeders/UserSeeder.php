<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Utama',
                'email' => 'admin@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Site Manager',
                'email' => 'budi@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'site_manager',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Site Manager',
                'email' => 'siti@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'site_manager',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agus Leader',
                'email' => 'agus@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'leader',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rina Leader',
                'email' => 'rina@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'leader',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Eko Visitor',
                'email' => 'eko@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'visitor',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dewi Visitor',
                'email' => 'dewi@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'visitor',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fajar Visitor',
                'email' => 'fajar@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'visitor',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gita Visitor',
                'email' => 'gita@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'visitor',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hadi Visitor',
                'email' => 'hadi@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'visitor',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        User::insert($users);
    }
}
