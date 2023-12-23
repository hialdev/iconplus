<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pesanan 1
        DB::table('pesanans')->insert([
            'id_user' => 1,
            'id_room' => rand(1,6),
            'date_meeting' => now(),
            'hour_start' => '09:00:00',
            'hour_end' => '10:00:00',
            'total_participants' => 15,
            'id_konsumsi' => 1,
            'id_status' => 1,
            'keterangan' => 'Keterangan untuk meeting 1.',
        ]);

        // Pesanan 2
        DB::table('pesanans')->insert([
            'id_user' => 2,
            'id_room' => rand(1,6),
            'date_meeting' => now(),
            'hour_start' => '11:30:00',
            'hour_end' => '13:00:00',
            'total_participants' => 20,
            'id_konsumsi' => 2,
            'id_status' => 2,
            'keterangan' => 'Keterangan untuk meeting 2.',
        ]);

        // Pesanan 3
        DB::table('pesanans')->insert([
            'id_user' => 3,
            'id_room' => rand(1,6),
            'date_meeting' => now(),
            'hour_start' => '14:30:00',
            'hour_end' => '16:00:00',
            'total_participants' => 10,
            'id_konsumsi' => 3,
            'id_status' => 1,
            'keterangan' => 'Keterangan untuk meeting 3.',
        ]);

        // Pesanan 4
        DB::table('pesanans')->insert([
            'id_user' => 4,
            'id_room' => rand(1,6),
            'date_meeting' => now(),
            'hour_start' => '17:30:00',
            'hour_end' => '18:30:00',
            'total_participants' => 12,
            'id_konsumsi' => 1,
            'id_status' => 3,
            'keterangan' => 'Keterangan untuk meeting 4.',
        ]);
    }
}
