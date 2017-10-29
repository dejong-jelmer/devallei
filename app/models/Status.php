<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Reason;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;


class Status extends Model
{
    
    protected $fillable = [
        'status',
        'student_selectable',
        'text',


    ];

    // Relationships
    
    /*
     * get the student that belongs to the status 
     */
    public function students()
    {
        return $this->hasMany('App\Models\Student', 'student_id');
    }


    public function reasons()
    {
        return $this->hasMany('App\Models\Reason');
    }



    // Model methods ----------------------------------------------------------
    
    
}