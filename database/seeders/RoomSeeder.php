<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('rooms')->insert([
                'id_unit' => 1, // pilih secara acak unit
                'name' => 'Room ' . $i,
                'capacity' => rand(5, 20), // kapasitas ruang acak antara 5 dan 20
            ]);
        }
    }
}
