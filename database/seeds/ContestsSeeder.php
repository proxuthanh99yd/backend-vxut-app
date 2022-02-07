<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contests')->insert([
            ['name' => 'Từ vựng'],
            ['name' => 'Ngữ pháp, đọc hiểu'],
            ['name' => 'Nghe hiểu'],
            ['name' => 'Từ vựng, ngữ pháp, đọc hiểu'],
        ]);
    }
}
