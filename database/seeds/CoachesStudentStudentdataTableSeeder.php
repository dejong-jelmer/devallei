<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CoachesStudentStudentdataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\Models\Coach::class, 20)
        ->create()
        ->each(
            function ($coach) {
            
                $coach->coachData()->save(factory(App\Models\Coachdata::class)->make());

                $coach->students()->saveMany(factory(App\Models\Student::class, 10)->make())
                    ->each(
                        function ($student) {
                            $student->studentdata()->save(factory(App\Models\Studentdata::class)->make());    
                    }); 
        });
        
    }

}
