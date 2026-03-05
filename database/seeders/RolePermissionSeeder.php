<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Gunakan firstOrCreate agar tidak error jika sudah ada
        Permission::firstOrCreate(['name' => 'view reports']);
        Permission::firstOrCreate(['name' => 'manage kunjungan']);
        Permission::firstOrCreate(['name' => 'delete kunjungan']);

        // Buat atau ambil role yang sudah ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $petugasRole = Role::firstOrCreate(['name' => 'petugas']);

        // Sync permissions (mengganti permissions lama dengan yang baru)
        // Gunakan syncPermissions agar tidak duplicate
        $adminRole->syncPermissions([
            'view reports',
            'manage kunjungan',
            'delete kunjungan'
        ]);

        $petugasRole->syncPermissions([
            'view reports',
            'manage kunjungan'
        ]);
    }
}
