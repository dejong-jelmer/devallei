<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Coachdata;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class StatusController
 * @package App\Http\Controllers
 */


class StatusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * GET /statuses/alle
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function getAllStatuses()
    {
        return Status::all()->toArray();
    }

    /**
     * GET /statuses/selectable
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function getSelectableStatuses()
    {
        return Status::where('student_selectable', true)->get()->toArray();
    }
}
