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
        DB::Table('statuses')->insert([
                'status' => 'afwezig',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::Table('statuses')->insert([
                'status' => 'aanwezig',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            
        DB::Table('statuses')->insert([
                'status' => 'ziek',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::Table('statuses')->insert([
                'status' => 'bijzonder_verlof',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::Table('statuses')->insert([
                'status' => 'geschorst',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::Table('statuses')->insert([
                'status' => 'geoorloofd_verzuim',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::Table('statuses')->insert([
                'status' => 'ongeoorloofd_verzuim',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }
}
            
