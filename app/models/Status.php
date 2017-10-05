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
    
    public function student()
    {
        return $this->hasMany('App\models\Student', 'student_id');
    }

    // Model methods
    
    
}