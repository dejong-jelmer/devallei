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
                'achternaam' => 'de Boer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

        DB::Table('coaches')->insert([
                'coach' => 'Judith',
                'voornaam'=> 'Judith',
                'achternaam' => 'Fransen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
    }
}
