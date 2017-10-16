<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coach;
use App\Models\Student;
use App\Models\Studentdata;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */

class StudentsController
{

    /**
     * set Auth middleware
     */
    function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * POST /leerlingen
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        try {
            
            $student = Student::create([
                'coach_id' => $request->coach_id,
                'status_id' => 1,
            ]);
            
            $studentData = studentData::create($request->all());
            $studentData->student()->associate($student);            
            $studentData->save();

        } catch (\Expetion $e) {
            dd(get_class($e));
        }

        return response()->json(['created' => true], 201, [
                // 'Location' => route('student.view', ['id' => $student->id ])
            ]);
    }
    
    /**
     * PUT /leerlingen/id
     * @param  Request $request
     * @param  $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        
        try {
            
            $student = Student::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'error'=> [
                        'message' => 'Leerling niet gevonden'
                    ]

                ], 404);
        }

        $student->update(['coach_id' => $request->coach_id]);
        $student->studentData()->first()->update($request->all());
        $student->save();

        return $student;
    }

    /**
     * DELETE /leerlingen/id 
     * @param  $id
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            
            $student = Student::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return response()->json([

                    'error' => [
                        'message' => 'Leerling niet gevonden'
                    ]
                ], 404);
        }

        $student->studentData()->delete();
        $student->delete();
        return response(null, 204);
    }


    /**
     * GET /student
     * @param  
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function viewData()
    {   
        
        $students = Student::with('studentdata');

        return [ 'data' => $students->get() ];
        
    }

    
    public function viewAllStatuses()
    {
        $students = Student::with('status');

        return $students->get(); 
    }

    public function viewSingelStatus($id)
    {
        try {

            $student = Student::findOrFail($id)->status()->first();
      
        } catch (ModelNotFoundException $e) {
            return response()->json([

                    'error' => [
                        'message' => 'Leerling niet gevonden'
                    ]
                ], 404);
        }

        return response()->json(['status' => $student->status ], 200);
    }


}