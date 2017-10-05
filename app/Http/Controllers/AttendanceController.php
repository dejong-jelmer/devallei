<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class CoachesController
 * @package App\Http\Controllers
 */

class AttendanceController
{
    /**
     * set Auth middleware
     */
    function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * GET /coachgroep/id 
     * @param  $id
     *
     * @return  mixed
     */
    public function updateStudentAttendance($id)
    {
        try {
            
            $student = Student::findOrFail($id);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([

                    'error' => [
                        'message' => 'Leerling niet gevonden.'
                    ]
                ], 404);
        }

        $aanwezig = Status::where('status', 'aanwezig')->first();

        if ($student->status->status !== 'aanwezig') {
            
            $student->createPresence();
            $student->status()->associate($aanwezig);
            $student->save();
        
        } else {
            
            $afwezig = Status::where('status', 'afwezig')->first();
            
            $student->updateAbsence();
            $student->status()->associate($afwezig);
            $student->save();

        }
        
        return response()->json(['status' => $student->status->status ], 201);
        
    }


}