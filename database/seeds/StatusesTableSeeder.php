<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $statuses = [
            'afwezig',
            'aanwezig',
            'tussen door uit',
            'activiteit',
            'bso',
            'ziek',
            'ziek naar huis',
            'bijzonder verlof',
        ];

        foreach ($statuses as $status) {
            DB::Table('statuses')->insert([
                'status' => $status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
    }
}
