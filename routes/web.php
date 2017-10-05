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
    $app->get('coachdata', 'CoachesController@index');
    $app->get('coaches/{id:[\d]+}', [
            'as' => 'coaches.view',
            'uses' => 'CoachesController@view',
        ]);
    $app->post('coaches', 'CoachesController@create');
    $app->put('coaches/{id:[\d]+}', 'CoachesController@update');
    $app->delete('coaches/{id:[\d]+}', 'CoachesController@delete');
    

    // group routes
    $app->get('coachgroep/alle', 'CoachGroupController@viewCoachGroups');
    $app->get('coachgroep/{id:[\d]+}', 'CoachGroupController@viewCoachGroup');

    // user routes
    $app->post('users', 'UsersController@create');

    // student routes
    $app->get('leerlingen', 'StudentsController@view');

    // attendance routes
    $app->put('leerlingen/updatestatus/{id:[\d]+}', 'AttendanceController@updateStudentAttendance');

    
});

