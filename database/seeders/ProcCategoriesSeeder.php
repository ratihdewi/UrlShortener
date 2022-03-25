<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_categories')->insert([
            ['name' => 'Barang IT', 'code' => 'S-S-SS-SSS'],
            ['name' => 'Barang Lab', 'code' => 'K-K-KK-KKK'],
        ]);
    }
}
