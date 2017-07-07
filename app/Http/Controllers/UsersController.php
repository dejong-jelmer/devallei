<?php 

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */

class UsersController
{

    /**
     * set Auth middleware
     */
    function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * POST /users
     * @param  Request $request [description]
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $request['naam'] = str_random(8);
        $request['api_token'] = str_random(60);
        $request['wachtwoord'] = app('hash')->make($request['wachtwoord']);

        try {
            $user = User::create($request->all());
        } catch (\Exception $e) {
            dd(get_class($e));
        }

        return response()->json(['created' => true,
                ['user' => $user],
            ], 201);
    }



}