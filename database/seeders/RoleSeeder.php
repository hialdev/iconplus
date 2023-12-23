<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'superadmin', 'guard_name' => 'web'])->givePermissionTo(['dashboard','manage_admin','manage_content']);
        Role::create(['name' => 'admin', 'guard_name' => 'web'])->givePermissionTo(['dashboard', 'manage_content']);
        Role::create(['name' => 'pegawai', 'guard_name' => 'web'])->givePermissionTo(['dashboard']);
    }
}
