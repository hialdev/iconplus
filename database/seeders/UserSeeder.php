<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $su = User::create([
            'name' => 'Devtektif | Nur Alif',
            'email' => 'al@devtektif.com',
            'password' => bcrypt('password'),
            'id_unit' => 1,
        ]);
        $su->assignRole('superadmin');
        
        $pegawai = User::create([
            'name' => 'Ganjar Subianto Baswedan',
            'email' => 'pegawai@devtektif.com',
            'password' => bcrypt('password'),
            'id_unit' => 1,
        ]);
        $pegawai->assignRole('pegawai');

        $admin = User::create([
            'name' => 'AL Gans',
            'email' => 'admin@devtektif.com',
            'password' => bcrypt('password'),
            'id_unit' => 1,
        ]);
        $admin->assignRole('admin');
    }
}
