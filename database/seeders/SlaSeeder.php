<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_sla')->insert([
            ['mechanism_type' => 0, 'process' => 'SPPH', 'time' => 7],
            ['mechanism_type' => 0, 'process' => 'Evaluasi Tender', 'time' => 7],
            ['mechanism_type' => 0, 'process' => 'BA Negosiasi dan Klarifikasi', 'time' => 7],
            ['mechanism_type' => 0, 'process' => 'BAPP', 'time' => 7],
            ['mechanism_type' => 0, 'process' => 'PO', 'time' => 7],
            ['mechanism_type' => 0, 'process' => 'BAST', 'time' => 7],
            ['mechanism_type' => 0, 'process' => 'Penilaian Vendor', 'time' => 7],
            ['mechanism_type' => 0, 'process' => 'Input SP3', 'time' => 7],

            ['mechanism_type' => 1, 'process' => 'SP3', 'time' => 5],
            ['mechanism_type' => 1, 'process' => 'BAST', 'time' => 5],
            ['mechanism_type' => 1, 'process' => 'Input PJ', 'time' => 5],
        ]);
    }

}
