<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Reason;
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
    public function updateStudentAttendance($id, Request $request /*$status=false, $reason_text=false*/)
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
        
        // Check if $request->status or $request->reden have been set
        array_key_exists('status', $request->toArray()) ? $status = $request->status : $status = false;
        array_key_exists('reden', $request->toArray()) ? $reason_text = $request->reden : $reason_text = false;

    
        $aanwezig = Status::where('status', 'aanwezig')->first();

        if ($student->status->status !== 'aanwezig') {
            $student->setAttendance($aanwezig);
            $student->status()->associate($aanwezig);
            $student->save();
        
            return response()->json(['status' => $student->status->status ], 201);
        }

        $afwezig = Status::where('status', 'afwezig')->first();
        
        if ($student->status->status == 'aanwezig' && $status == false) {
            
            $student->setAttendance($afwezig);
            $student->status()->associate($afwezig);
            $student->save();

            return response()->json(['status' => $student->status->status ], 201);
        }

        $tussen_door_uit = Status::where('status', 'tussen door uit')->first();

        switch ($status) {
            case 'tussen_door_uit':
                    
                    $reason = Reason::create(['reason' => $reason_text]);

                    $reason->student()->associate($student);
                    $reason->status()->associate($tussen_door_uit);
                    $reason->save();

                    $student->setAttendance($tussen_door_uit, $reason);
                    $student->status()->associate($tussen_door_uit);
                    $student->save();
                
                return response()->json(['status' => $student->status->status, 'reden' => $reason->reason ], 201);
                break;
            
            default:
                # code...
                break;
        }

        
        // $activiteit = Status::where('status', 'activiteit')->first();
        // $bso = Status::where('status', 'bso')->first();
        // $ziek = Status::where('status', 'ziek')->first();
        // $ziek_naar_huis = Status::where('status', 'ziek naar huis')->first();
        // $bijzonder_verlof = Status::where('status', 'bijzonder verlof')->first();
        
        
        
    }

    public function viewReason($id)
    {
        
        $status = Status::findOrFail($id);
        return $status->reason()->first();
    }


}