<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coach;
use App\Models\Student;
use App\Models\Coachdata;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class CoachesController
 * @package App\Http\Controllers
 */

class CoachController
{
    /**
     * set Auth middleware
     */
    function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * GET /coaches
     * @return  array
     */
   
    public function index()
    {
        // return Coach::all();
        return [ 'data' => Coach::all()->toArray() ];
    }

    
    /**
    * GET /coaches/{id}
    * @param integer $id
    * @return mixed
    */

    public function view($id)
    {
        try {
            return Coach::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'error' => [
                        'message' => 'coach niet gevonden'
                    ],

                    'status' => 404
                    ], 404);
        }
    }

    /**
     * POST /coaches
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        try {
            
            $coach = Coach::create(['coach' => $request->voornaam ]);
            
            $coachData = coachData::create($request->all());
            $coachData->coach()->associate($coach);            
            $coachData->save();

        } catch (\Expetion $e) {
            dd(get_class($e));
        }

        return response()->json(['created' => true], 201, [
                'Location' => route('coaches.view', ['id' => $coach->id ])
            ]);
    }
    
    /**
     * PUT /coaches/id
     * @param  Request $request
     * @param  $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        
        try {
            
            $coach = Coach::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'error'=> [
                        'message' => 'coach niet gevonden'
                    ]

                ], 404);
        }

        $coach->update(['coach' => $request->voornaam]);
        $coach->coachData()->first()->update($request->all());
        $coach->save();

        return $coach;
    }

    /**
     * DELETE /coaches/id 
     * @param  $id
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            
            $coach = Coach::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return response()->json([

                    'error' => [
                        'message' => 'coach niet gevonden'
                    ]
                ], 404);
        }
        
        $coach->coachData()->detete();
        $coach->delete();
        return response(null, 204);
    }


}