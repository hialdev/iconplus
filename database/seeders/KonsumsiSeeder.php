<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonsumsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Konsumsi 1
        DB::table('konsumsis')->insert([
            'name' => 'Snack Pagi',
            'detail' => 'Paket snack untuk pagi hari',
        ]);

        // Konsumsi 2
        DB::table('konsumsis')->insert([
            'name' => 'Makan Siang',
            'detail' => 'Paket makan siang untuk meeting tengah hari',
        ]);

        // Konsumsi 3
        DB::table('konsumsis')->insert([
            'name' => 'Snack Sore',
            'detail' => 'Paket snack untuk sore hari',
        ]);
    }
}
