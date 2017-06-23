<?php

use Carbon\Carbon;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        
        DB::Table('users')->insert([
                'pin_code' => "123456",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

    }
}
