<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->group(['prefix' => 'api/v1/', 'middleware' => ['cors', /*'auth'*/]], function($app){

    $app->get('/', function() {   
        return view('index');
    });

    //coach routes
    $app->get('coaches', 'CoachesController@index');
    $app->get('coaches/{id:[\d]+}', [
            'as' => 'coaches.view',
            'uses' => 'CoachesController@view',
        ]);
    $app->post('coaches', 'CoachesController@create');
    $app->put('coaches/{id:[\d]+}', 'CoachesController@update');
    $app->delete('coaches/{id:[\d]+}', 'CoachesController@delete');


    // user routes
    $app->post('users', 'UsersController@create');
});


// $app->get('/hallo/{naam}', function($naam) use ($app) {

//     return "Hallo {$naam}";
// });

// $app->get('/request', function (Illuminate\Http\Request $request) {
//     return "Hallo " . $request->get('name', 'stranger');
// });

// $app->get('/response', function (Illuminate\Http\Request $request) {
//     if($request->wantsJson()) {
//         return response()->json(['greeting' => 'Hello stranger']);
//     }


//     return response()
//     ->make('Hello stranger', 200, ['Content-Type', 'text/plain']);
// });