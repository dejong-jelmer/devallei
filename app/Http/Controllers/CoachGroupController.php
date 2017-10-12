<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coach;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class CoachesController
 * @package App\Http\Controllers
 */

class CoachGroupController
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
    public function viewCoachGroups()
    {
        return $coaches = Coach::get(['id', 'coach']);

    }

    /**
     * GET /coachgroep/id 
     * @param  $id
     *
     * @return  mixed
     */
    public function viewCoachGroup($id)
    {
        try {

           return $coach = Coach::findOrFail($id)->getStudents()->toArray();
      
        } catch (ModelNotFoundException $e) {
            return response()->json([

                    'error' => [
                        'message' => 'Groep niet gevonden'
                    ]
                ], 404);
        }

    }

}