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
    public function view()
    {   
        $students = Student::all();
        $response = [];
        foreach ($students as $student) {
            array_push($response, $student->studentdata()->get());
        }
            return [ 'data' => $response ];
        // return [ 'data' => $student->studentdata()->get() ];
        
    }

    



}