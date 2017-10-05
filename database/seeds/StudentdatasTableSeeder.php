<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StudentdatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('studentdatas')->insert([
                'student_id' => '1',
                'voornaam'=> 'Moon',
                'tussenvoegsel' => 'van der',
                'achternaam' => 'Zanden',
                'emailadres' => 'moontjeishier@ziggo.nl',
                'telefoon_1' => '024-1234567',
                'straat' => 'Lelieplein',
                'huisnummer' => '3',
                'huisnummer_toevoeging' => 'b',
                'postcode' => '6524DF',
                'leerlingnummer' => random_int(000000, 999999),
                'ouder_verzorger_1' => 'Monique Henderix',
                'ouder_verzorger_1' => 'Fred van der Zanden',
                // 'aanwezig' => random_int(0,2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

        DB::Table('studentdatas')->insert([
                'student_id' => '2',
                'voornaam'=> 'Kjeld',
                'achternaam' => 'Caro',
                'emailadres' => 'kjeldjepeltje@gmail.com',
                'telefoon_1' => '080-1234567',
                'straat' => 'de Ontdekking',
                'huisnummer' => '6',
                'postcode' => '2323TR',
                'leerlingnummer' => random_int(000000, 999999),
                'ouder_verzorger_1' => 'Elske de Jong',
                'ouder_verzorger_1' => 'Wouter Caro',
                // 'aanwezig' => random_int(0,2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

        DB::Table('studentdatas')->insert([
                'student_id' => '3',
                'voornaam'=> 'Brend',
                'achternaam' => 'Caro',
                'emailadres' => 'brendjepentje@gmail.com',
                'telefoon_1' => '080-1234567',
                'straat' => 'de Ontdekking',
                'huisnummer' => '6',
                'postcode' => '2323TR',
                'leerlingnummer' => random_int(100000, 999999),
                'ouder_verzorger_1' => 'Elske de Jong',
                'ouder_verzorger_1' => 'Wouter Caro',
                // 'aanwezig' => random_int(0,2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
    }
}
            
