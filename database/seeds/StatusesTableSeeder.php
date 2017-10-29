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
            'afwezig' => [
                'student_selectable' => 1, 
                'text' => 'Afmelden', 
                'color' => '#73C5E1',
            ],
            'aanwezig' => [
                'student_selectable' => 0, 
                'text' => 'Aanmelden',
                'color' => '#5BB12F',
            ],
            'tussendoor uit' => [
                'student_selectable' => 1,
                'text' => 'Tussendoor uit',
                'color' =>'#FFA200',
            ],
            'activiteit' => [
                'student_selectable' => 0,
                'text' => 'Activiteit, buiten school',
                'color' => '#982395',
            ],
            'bso' => [
                'student_selectable' => 0, 
                'text' => 'Buitenschoolse opvang',
                'color' => '#0087CB',
            ],
            'ziek' => [
                'student_selectable' => 0,
                'text' => 'Ziek',
                'color' => '#9B539C',
            ],
            'ziek naar huis' => [
                'student_selectable' => 1,
                'text' => 'Ziek naar huis',
                'color' => '#EB65A0',
            ],
            'bijzonder verlof' => [
                'student_selectable' => 0, 
                'text' => 'Bijzonder verlof',
                'color' => '#354458',
            ],
        ];

        foreach ($statuses as $status => $selectable) {
            DB::Table('statuses')->insert([
                'status' => $status,
                'student_selectable' => $selectable['student_selectable'],
                'text' => $selectable['text'],
                'color' => $selectable['color'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
    }
}
