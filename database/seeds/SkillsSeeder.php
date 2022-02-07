<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            ['name' => 'Từ vựng - Chữ hán'],
            ['name' => 'Ngữ pháp'],
            ['name' => 'Đọc hiểu'],
            ['name' => 'Nghe hiểu'],
        ]);
    }
}
