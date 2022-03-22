<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            ['name' => 'Super Admin', 'parent_id' => 0],
            ['name' => 'Manager Pengadaan', 'parent_id' => 0],
            ['name' => 'Staff Pengadaan', 'parent_id' => 2],
            ['name' => 'User', 'parent_id' => 0]
        ]);
    }
}
