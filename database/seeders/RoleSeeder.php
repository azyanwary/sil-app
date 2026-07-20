<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\PermissionType;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Role: Super Admin (Staf TI)
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        // Super Admin mendapatkan semua hak akses
        $superAdmin->syncPermissions(Permission::all());

        // 2. Role: Pengelola Situs
        $pengelolaSitus = Role::firstOrCreate(['name' => 'Pengelola Situs', 'guard_name' => 'web']);
        $pengelolaSitus->syncPermissions([
            PermissionType::MANAGE_HERITAGE_SITES->value,
            PermissionType::MANAGE_SITE_CATEGORIES->value,
            PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value,
            PermissionType::MANAGE_SITE_CONDITION_REPORTS->value,
            PermissionType::MANAGE_REPORTS->value,
        ]);

        // 3. Role: Pimpinan
        $pimpinan = Role::firstOrCreate(['name' => 'Pimpinan', 'guard_name' => 'web']);
        $pimpinan->syncPermissions([
            PermissionType::MANAGE_REPORTS->value, // Pimpinan biasanya hanya memantau laporan
        ]);

        // 4. Role: Pemohon (Masyarakat/Pengguna Umum)
        $pemohon = Role::firstOrCreate(['name' => 'Pemohon', 'guard_name' => 'web']);
        $pemohon->syncPermissions([
            PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value, // Mengajukan penggunaan fasilitas
        ]);
    }
}
