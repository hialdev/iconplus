<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatusSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            KonsumsiSeeder::class,
            UnitSeeder::class,
            UserSeeder::class,
            PegawaiSeeder::class,
            PesananSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
