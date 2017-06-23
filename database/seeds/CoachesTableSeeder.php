<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CoachesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        
        DB::Table('coaches')->insert([
                'coach' => 'Tim',
                'voornaam'=> 'Tim',
                'tussenvoegsel' => 'de',
                'achternaam' => 'Boer',
                'email' => 'timdeboer@live.nl',
                'telefoon' => '024-1234567',
                'mobiel' => '06-12345678',
                'straat' => 'Daliastraat',
                'huisnummer' => '28',
                'postcode' => '6524DF',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

        DB::Table('coaches')->insert([
                'coach' => 'Judith',
                'voornaam'=> 'Judith',
                'tussenvoegsel' => '',
                'achternaam' => 'Fransen',
                'email' => 'j.fransen@gmail.com',
                'telefoon' => '024-7654321',
                'mobiel' => '06-87654321',
                'straat' => 'Dreef',
                'huisnummer' => '313',
                'postcode' => '6523MS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
    }
}
