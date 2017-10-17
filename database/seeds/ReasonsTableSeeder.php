<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reasons = [
            'supermarkt',
            'voetbalveld',
            'vo',
            'huis',
        ];

        foreach ($reasons as $reason) {
            DB::Table('reasons')->insert([
                'reason' => $reason,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
