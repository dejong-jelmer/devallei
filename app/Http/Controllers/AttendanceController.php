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
 * Class AttendanceController
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
    public function updateStudentAttendance($id, Request $request)
    {
        $reason = false;
        $statusUpdate = false;
        $reasonUpdate = false;

        // hier nog naar kijken want nu wordt reden altijd in request meegegeven en bestaat array key reden dus en wordt $reasonUpdate dus een lege string en niet "false" waar die later wel op checked wordt.
        // Check if POST had status and / or reden 
        array_key_exists('status', $request->toArray()) ? $statusUpdate = $request->status : $statusUpdate = false;
        (array_key_exists('reden', $request->toArray()) && $request->reden != '') ? $reasonUpdate = $request->reden : $reasonUpdate = false;
        

        try {
            
            $student = Student::findOrFail($id);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Leerling niet gevonden.'
                ]
            ], 404);
        }
        
        try {

            $status = Status::where('status', $statusUpdate)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Status niet bekend.'
                ]
            ], 404);
        }
        

        if ($student->status->status !== $statusUpdate) {
            if ($reasonUpdate !== false) {
                $reason = Reason::create(['reason' => $reasonUpdate]);
            }
            
            if($reason) {
                $reason->student()->associate($student);
                $reason->status()->associate($status);
                $reason->save();

                $student->reason()->associate($reason);
                // $student->save();
            }

            $student->setAttendance($status, $reason);
            $student->status()->associate($status);
            $student->save();
        }
        // return $student->reason->reason;

        return response()->json(['id' => $student->id, 'status' => $student->status->status, 'color' => $student->status->color, 'reden' => ($reason ? $student->reason->reason : null) ], 201);      
        
        
    }

    public function viewReason($id)
    {
        
        $status = Status::findOrFail($id);
        return $status->reason()->first();
    }


}