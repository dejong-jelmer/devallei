<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;


class Status extends Model
{
    
    protected $fillable = [
        'status',

    ];

    // Relationships
    
    /*
     * get the student that belongs to the status 
     */
    public function student()
    {
        return $this->hasMany('App\Models\Student', 'student_id');
    }

    // Model methods
    
    
}