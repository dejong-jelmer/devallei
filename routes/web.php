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
$app->group(['prefix' => 'api/v1/', 'middleware' => ['cors']], function($app){

    //test
    $app->get('/', function(){return view("index");});
    // auth
    $app->post('auth/login', 'AuthController@authenticate');

    $app->group(['middleware' => [/*'cors','jwt.auth'*/]], function($app){

       
        // user routes
        $app->post('users', 'UserController@create');

        // status routes
        $app->get('statuses/alle', 'StatusController@getAllStatuses');
        $app->get('statuses/selectable', 'StatusController@getSelectableStatuses');
        
        //coach routes
        $app->get('coachdata', 'CoachController@index');
        $app->get('coaches/{id:[\d]+}', [
                'as' => 'coaches.view',
                'uses' => 'CoachController@view',
            ]);
        $app->post('coaches', 'CoachController@create');
        $app->put('coaches/{id:[\d]+}', 'CoachController@update');
        $app->delete('coaches/{id:[\d]+}', 'CoachController@delete');
        
        // coach group routes
        $app->get('coachgroep/alle', 'CoachGroupController@viewCoachGroups');
        $app->get('coachgroep/{id:[\d]+}', 'CoachGroupController@viewCoachGroup');

        // student routes
        $app->post('leerlingen', 'StudentController@create');
        $app->put('leerlingen/{id:[\d]+}', 'StudentController@update');
        $app->delete('leerlingen/{id:[\d]+}', 'StudentController@delete');
        
        $app->get('leerlingen/data', 'StudentController@viewData');
        $app->get('leerlingen/status', 'StudentController@viewAllStatuses');
        $app->get('leerlingen/status/{id:[\d]+}', 'StudentController@viewSingelStatus');

        // attendance routes
        // $app->get('leerlingen/updatestatus/{id:[\d]+}[/{status}[/{reason_text}]]', 'AttendanceController@updateStudentAttendance');
        $app->post('leerlingen/updatestatus/{id:[\d]+}', 'AttendanceController@updateStudentAttendance');

        $app->get('leerlingen/status/{id:[\d]+}/reden', 'AttendanceController@viewReason');

        
    });

});
