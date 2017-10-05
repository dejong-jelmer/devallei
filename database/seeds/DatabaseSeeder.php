<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call(CoachesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(StudentdatasTableSeeder::class);
    }
}
