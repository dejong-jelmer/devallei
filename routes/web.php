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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/coaches', 'CoachesController@index');


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