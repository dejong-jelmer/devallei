<?php

namespace Tests\App\Http\Controllers;

use TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class AttendanceControllerTest extends TestCase
{
    
    use DatabaseMigrations;

    /**
     * @test
     */
    public function update_aanwezig_should_only_change_fillable_fields()
    {
        $student = factory('App\Models\Student')->create();
        $attendance = factory('App\Models\Attendance')->create();

        $this->put("/api/v1/leerlingen/aanwezigheidmelden/{$student->id}", [
                'aanwezig' => 1,
            ]);

        $this
            ->seeStatusCode(201)
            ->seeJson([
                'aanwezig' => 1,
            ])
            ->seeInDatabase('students', [
                    'aanwezig' => 1,
                ])
            ->seeInDatabase('attendances', [
                    'student_id' => $attendance->id,
                    'aanwezig' => $attendance->aanwezig,
                    'afwezig' => $attendance->afwezig,
            ]);
    }

}