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
                'spatie_role' => 'Super Admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Budi Site Manager',
                'email' => 'budi@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'site_manager',
                'spatie_role' => 'Pengelola Situs',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Siti Site Manager',
                'email' => 'siti@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'site_manager',
                'spatie_role' => 'Pengelola Situs',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Agus Leader',
                'email' => 'agus@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'leader',
                'spatie_role' => 'Pimpinan',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rina Leader',
                'email' => 'rina@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'leader',
                'spatie_role' => 'Pimpinan',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Eko Visitor',
                'email' => 'eko@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'visitor',
                'spatie_role' => 'Pemohon',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dewi Visitor',
                'email' => 'dewi@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'visitor',
                'spatie_role' => 'Pemohon',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Fajar Visitor',
                'email' => 'fajar@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'visitor',
                'spatie_role' => 'Pemohon',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Gita Visitor',
                'email' => 'gita@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'visitor',
                'spatie_role' => 'Pemohon',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Hadi Visitor',
                'email' => 'hadi@sil.local',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'visitor',
                'spatie_role' => 'Pemohon',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            $spatieRole = $userData['spatie_role'];
            unset($userData['spatie_role']);
            
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            if ($spatieRole) {
                $user->assignRole($spatieRole);
            }
        }
    }
}
