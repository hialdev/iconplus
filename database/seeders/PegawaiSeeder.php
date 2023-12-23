<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 8; $i++) {
            DB::table('pegawais')->insert([
                'id_user' => $i,
                'NIP' => 'NIP' . $i,
                'nama' => 'Pegawai ' . $i,
            ]);
        }
    }
}
