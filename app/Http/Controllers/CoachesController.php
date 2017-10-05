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

class CoachesController
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
            
            $coach = Coach::create($request->all());
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

        $coach->fill($request->all());
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

        $coach->delete();
        return response(null, 204);
    }


}