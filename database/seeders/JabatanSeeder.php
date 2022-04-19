<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_jabatan')->insert([
            ['code' => 1, 'name' => 'Rektor'],
            ['code' => 2, 'name' => 'Wakil Rektor'],
            ['code' => 3, 'name' => 'Dekan'],
            ['code' => 4, 'name' => 'Direktur'],
            ['code' => 5, 'name' => 'Manager'],
            ['code' => 6, 'name' => 'Ketua Program Studi'],
            ['code' => 7, 'name' => 'Dosen'],
        ]);
    }
}
