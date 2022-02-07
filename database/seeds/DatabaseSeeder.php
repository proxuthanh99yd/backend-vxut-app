<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            LevelsSeeder::class,
            RolesSeeder::class,
            AccountSeeder::class,
            ContestsSeeder::class
        ]);
    }
}
