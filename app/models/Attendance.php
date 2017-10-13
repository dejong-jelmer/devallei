<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coach;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;


class Attendance extends Model
{
    
    protected $fillable = [
        'student_id',
        'aanwezig_van',
        'aanwezig_tot',
        'afwezig_van',
        'afwezig_tot',
    ];

    // Relationships
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

      
}