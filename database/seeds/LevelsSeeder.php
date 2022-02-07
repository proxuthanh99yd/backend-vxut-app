<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            ['name' => 'Không xác định'],
            ['name' => 'N5'],
            ['name' => 'N4'],
            ['name' => 'N3'],
            ['name' => 'N2'],
        ]);
    }
}
