<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coach;
use App\Models\Student;
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