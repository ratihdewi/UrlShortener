<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MechanismSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procurement_mechanisms')->insert([
            ['name' => 'Tender'],
            ['name' => 'UMK'],
            ['name' => 'Tender Penunjukan Langsung'],
            ['name' => 'Tender Afiliasi'],
            ['name' => 'Direct Purchase'],
        ]);
    }
}
