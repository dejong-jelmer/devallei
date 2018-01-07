<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;

use Laravel\Lumen\Routing\Controller as BaseController;


/**
 * Class AuthController
 * @package App\Http\Controllers
 */

class AuthController extends BaseController 
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Create a new token.
     * 
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt(User $user) {
        
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60*60 // Expiration time
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    } 

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     * 
     * @param  \App\User   $user 
     * @return mixed
     */
    public function authenticate(User $user) {
        
        $this->validate(
            
            $this->request, [
                'naam'     => 'required',
                'wachtwoord'  => 'required'
        ]);

        $user = User::where('naam', $this->request->input('naam'))->first();

        if (!$user) {
            
            return response()->json([
                'error' => 'Naam komt niet in het systeem voor.'
            ], 400);
        }

        if (Hash::check($this->request->input('wachtwoord'), $user->wachtwoord)) {
            
            return response()->json([
                
                'token' => $this->jwt($user)
            
            ], 200);
        }

        // Bad Request response
        return response()->json([
            'error' => 'Naam of wachtwoord zijn niet juist.'
        ], 400);
    }
}
