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
                'naam' => 'devallei',
                'wachtwoord' => str_random(8),
                'api_token' => 'KSJqsJATbhPru78C5D2mbmnH0jGgQRUoWZONcLvch95OvB90LbHIS9ij3RJj',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

    }
}
